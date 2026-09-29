<?php
// Run after loading the preview WordPress over SSH stdin.
if ( PHP_SAPI !== 'cli' || ! defined( 'ABSPATH' ) ) { exit( 1 ); }
if ( false === strpos( home_url(), 'korovai.crazytest.ru/daysi' ) ) { throw new Exception( 'Preview only' ); }

function certificate_assert( $condition, $message ) {
	if ( ! $condition ) { throw new Exception( $message ); }
	echo 'PASS: ' . $message . "\n";
}

function certificate_dom( $attrs ) {
	$dom = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( '<?xml encoding="utf-8" ?>' . dicey_render_dietology( $attrs ) );
	libxml_clear_errors();
	return new DOMXPath( $dom );
}

$gallery_query = '//a[@data-fancybox="dietology-certificates"]';
$thumb_query = $gallery_query . '[not(@hidden)]/img';
$items = array_map( function ( $number ) { return array( 'image' => 'https://example.test/certificate-' . $number . '.jpg' ); }, range( 1, 8 ) );
$dom = certificate_dom( array( 'plan_certificates' => $items ) );
certificate_assert( 8 === $dom->query( $gallery_query )->length, 'All eight certificates belong to the gallery' );
certificate_assert( 2 === $dom->query( $thumb_query )->length, 'Only the first two certificates render thumbnails' );
certificate_assert( 6 === $dom->query( $gallery_query . '[@hidden and not(img)]' )->length, 'Additional certificates do not add visible images or preload full scans' );
foreach ( $dom->query( $gallery_query ) as $index => $link ) {
	certificate_assert( $items[ $index ]['image'] === $link->getAttribute( 'href' ), 'Gallery order ' . ( $index + 1 ) );
}
certificate_assert( 1 === $dom->query( '//a[@data-fancybox-trigger="dietology-certificates" and @data-fancybox-index="0"]' )->length, 'View-all link opens the same gallery at its first slide' );
$dom = certificate_dom( array( 'plan_certificates' => array() ) );
certificate_assert( 0 === $dom->query( $gallery_query )->length, 'Deleting every certificate does not resurrect defaults' );
certificate_assert( 0 === $dom->query( '//a[@data-fancybox-trigger]' )->length, 'No broken view-all link for an empty list' );
$dom = certificate_dom( array( 'plan_certificates' => array( array( 'image' => '' ), $items[0], array( 'image' => '  ' ), $items[1], $items[2] ) ) );
certificate_assert( 3 === $dom->query( $gallery_query )->length && 2 === $dom->query( $thumb_query )->length, 'Empty upload rows do not consume the two thumbnail positions' );
$dom = certificate_dom( array() );
certificate_assert( 2 === $dom->query( $thumb_query )->length, 'Legacy pages without the field keep their original defaults' );
echo "All certificate renderer checks passed. No database changes.\n";
