$(document).ready(function () {

	// Открытие поп апов
	$('.open_popup').click(function (event) {

		event.preventDefault();

		var $id = $(this).data('modal');

		$('body')
			.addClass('__hidden')
			.find($id)
			.addClass('__visible');

	});

	// Закрытие поп апа
	$('.close_popup_icon').click(function (event) {

		event.preventDefault();

		$('body')
			.removeClass('__hidden')
			.find('.popup_block')
			.removeClass('__visible');

	});
	$(document).mouseup(function (e) {
		var div = $('.popup_block .wrapper');

		if (!div.is(e.target) && div.has(e.target).length === 0) {
			$('body').removeClass('__hidden');
			$('.popup_block').removeClass('__visible');
		}
	});

	// Скролл до элемента
	$('.gta').click(function (e) {

		e.preventDefault();

		var $id = $(this).data('anchor');

		$('html, body').animate({ scrollTop: $($id).offset().top }, 400);

	});

	// Маска на номер телефона
	$('input[type="tel"]').mask('+7 (000) 000-00-00');
	$('input[type="tel"]').on('focus', function (event) {
		event.preventDefault();

		if ($(this).val().length == 0) {
			$(this).val('+7 ');
		}

	});
	$('input[type="tel"]').keyup(function (event) {

		event.preventDefault();

		if ($(this).val().length == 0) {
			$(this).val('+7 ');
		}

	});

});
Fancybox.bind("[data-fancybox]", {
	// Your custom options
});

$(".works__blocks .works__block").mouseenter(function () {

	let index = $(".works__blocks .works__block").index(this);
	$(this).siblings().removeClass("active");
	$(this).toggleClass("active");

	$(".works__blocks").removeClass("works__current-0");
	$(".works__blocks").removeClass("works__current-1");
	$(".works__blocks").removeClass("works__current-2");
	$(".works__blocks").removeClass("works__current-3");
	$(".works__blocks").removeClass("works__current-4");

	$(".works__blocks").addClass("works__current-" + index);


});

$(".advisory__blocks .advisory__block").mouseenter(function () {

	let index = $(".advisory__blocks .advisory__block").index(this);
	$(this).siblings().removeClass("active");
	$(this).toggleClass("active");

	$(".advisory__blocks").removeClass("advisory__current-0");
	$(".advisory__blocks").removeClass("advisory__current-1");
	$(".advisory__blocks").removeClass("advisory__current-2");
	$(".advisory__blocks").removeClass("advisory__current-3");
	$(".advisory__blocks").removeClass("advisory__current-4");

	$(".advisory__blocks").addClass("advisory__current-" + index);


});

$(document).on("click", ".container .standart__tab", function (e) {
	e.preventDefault();

	let $container = $(this).closest(".container");
	let $tabs = $container.find(".standart__tab");
	let index = $tabs.index(this);

	if (index < 0) {
		return;
	}

	$tabs.removeClass("active");
	$(this).addClass("active");

	let $contents = $container.find(".standart__tabcontent");

	if ($contents.length) {
		$contents.hide().removeClass("active");
		$contents.eq(index).show().addClass("active");
	}
});

$(".questions__top").click(function () {
	$(this).parent("div").toggleClass("active");
	$(this).next().slideToggle();
});




$(".dark,.burger-menu__close").click(function () {
	$(".burger-menu").removeClass("active")
	$(".dark").fadeOut(200)
})
$(".header-burger").click(function () {
	$(this).toggleClass("active")
	$(".burger-menu").toggleClass("active")
	$(".dark").fadeToggle(200)
})


$(".select-box li").click(function () {
	$(this).parents(".select-box").find("summary span").text($(this).text());

	$(this).parents(".select-box").attr("open", false);
	$(this).parents(".select-box").find("input[type='hidden']").val($(this).text());
});

$(".decoration__methods-block").click(function () {
	$(this).toggleClass("active");
	$(this).siblings().removeClass("active");
});


$(".product__img-slider").owlCarousel({
	items: 1,
	loop: true,
	dots: false,
	nav: true,
	navText: [`<svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9 1.00012C8.73247 1.17157 6.99259 2.91518 5.44174 4.48782C3.93085 6.01993 2.26556 7.06227 1.37185 8.03784C1.14953 8.28053 0.970679 8.52698 1.00401 8.73163C1.21925 10.053 3.4352 11.1809 4.59087 12.3337C5.6242 13.3645 6.67202 14.649 7.4785 15.6305C7.6804 15.8784 7.87339 16.1247 8.07399 16.3716C8.27459 16.6184 8.47695 16.8584 8.40382 17.0001" stroke="#5182A6" stroke-width="2" stroke-linecap="round"/>
</svg>
`,`<svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 1.00012C1.26753 1.17157 3.00741 2.91518 4.55826 4.48782C6.06915 6.01993 7.73444 7.06227 8.62815 8.03784C8.85047 8.28053 9.02932 8.52698 8.99599 8.73163C8.78075 10.053 6.5648 11.1809 5.40913 12.3337C4.3758 13.3645 3.32798 14.649 2.5215 15.6305C2.3196 15.8784 2.12661 16.1247 1.92601 16.3716C1.72541 16.6184 1.52305 16.8584 1.59618 17.0001" stroke="#5182A6" stroke-width="2" stroke-linecap="round"/>
</svg>
`],

});
$(".product__imgs img").click(function () {
	let index = $(".product__imgs img").index(this);
	$(".product__img-slider").owlCarousel("to", index);
	$(".product__imgs img").removeClass("active");
	$(this).addClass("active");
});

$(document).on("click", ".product__term-tab", function () {
	var $tab = $(this)
	var $product = $tab.closest(".product")
	var price = $tab.attr("data-variation-price")
	var variationId = $tab.attr("data-variation-id")
	var attributes = $tab.attr("data-variation-attributes")

	$tab.siblings(".product__term-tab").removeClass("active")
	$tab.addClass("active")

	if (price) {
		$product.find("[data-product-price]").text(price)
	}

	if (variationId) {
		$product.find("[data-variation-id-input]").val(variationId)
	}

	if (attributes) {
		try {
			var parsed = JSON.parse(attributes)
			Object.keys(parsed).forEach(function (name) {
				var $input = $product.find('.dicey-product-variation-attribute[name="' + name + '"]')
				if (!$input.length) {
					$input = $('<input type="hidden" class="dicey-product-variation-attribute">').attr("name", name)
					$product.find(".dicey-product-cart").append($input)
				}
				$input.val(parsed[name])
			})
		} catch (e) {}
	}
});

$(document).on("click", ".shop__block", function () {
	var $wr = $(this).closest(".shop__wr")
	if ($wr.data("drag-moved")) {
		$wr.data("drag-moved", false)
		return
	}
	$(this).toggleClass("active")
})
$(".sort-dropdown__top").click(function () {
	$(this).parent().toggleClass("active");
	$(this).next().slideToggle();
});
$(".sort-dropdown__item").click(function () {
	$(this).parents(".sort-dropdown").find(".sort-dropdown__top span").text($(this).text());
	$(this).parents(".sort-dropdown").removeClass("active");
	$(this).parents(".sort-dropdown").find(".sort-dropdown__menu").slideUp();
});
$(".shop__nav-tab").click(function () {
	$(this).siblings().removeClass("active");
	$(this).addClass("active");
});





function makeSwipeable(selector, opts) {
	var $blocks = $(selector)
	if (!$blocks.length) {
		return
	}
	opts = opts || {}

	var el = $blocks[0]
	var mqStr = opts.mq || "(max-width: 1199px)"
	var mq = window.matchMedia(mqStr)
	var childSel = opts.childSel || null
	var draggingClass = opts.draggingClass || "swipe-dragging"
	var onSnap = opts.onSnap || null

	var tx = 0
	var ptrId = null
	var startX = 0
	var startTx = 0
	var dragging = false
	var ptrMoveOpts = { passive: false }

	function bounds() {
		var parent = el.parentElement
		if (!parent) {
			return { min: 0, max: 0 }
		}
		var maxScroll = el.scrollWidth - parent.clientWidth
		return { min: Math.min(0, -maxScroll), max: 0 }
	}

	function clamp(v) {
		var b = bounds()
		return Math.max(b.min, Math.min(b.max, v))
	}

	function applyTransform(withTransition) {
		if (!mq.matches) {
			$blocks.css({ transform: "", transition: "" })
			return
		}
		$blocks.css({
			transition: withTransition ? "transform .22s ease-out" : "none",
			transform: "translate3d(" + tx + "px,0,0)",
		})
	}

	function snapToNearest() {
		var parent = el.parentElement
		if (!parent) {
			return
		}
		var mid = parent.getBoundingClientRect().left + parent.clientWidth * 0.5
		var children = childSel ? el.querySelectorAll(childSel) : el.children
		var bestTx = tx
		var bestAbs = Infinity
		for (var i = 0; i < children.length; i++) {
			var r = children[i].getBoundingClientRect()
			var candidate = clamp(tx + (mid - (r.left + r.width * 0.5)))
			var score = Math.abs(candidate - tx)
			if (score < bestAbs) {
				bestAbs = score
				bestTx = candidate
			}
		}
		tx = bestTx
		applyTransform(true)
		if (onSnap) {
			onSnap(children, mid)
		}
	}

	function reset() {
		tx = 0
		$blocks.css({ transform: "", transition: "" })
		$blocks.removeClass(draggingClass)
		dragging = false
		ptrId = null
	}

	function onPointerDown(e) {
		if (!mq.matches || dragging) {
			return
		}
		if (bounds().min >= 0) {
			return
		}
		if (e.pointerType === "mouse" && e.button !== 0) {
			return
		}
		ptrId = e.pointerId
		startX = e.clientX
		startTx = tx
		dragging = true
		$blocks.addClass(draggingClass)
		applyTransform(false)
		el.setPointerCapture(e.pointerId)
	}

	function onPointerMove(e) {
		if (!dragging || e.pointerId !== ptrId || !mq.matches) {
			return
		}
		if (e.pointerType === "touch" && e.cancelable) {
			e.preventDefault()
		}
		tx = clamp(startTx + (e.clientX - startX))
		applyTransform(false)
	}

	function onPointerUp(e) {
		if (e.pointerId !== ptrId) {
			return
		}
		var moved = Math.abs(tx - startTx) > 8
		dragging = false
		ptrId = null
		$blocks.removeClass(draggingClass)
		try {
			el.releasePointerCapture(e.pointerId)
		} catch (err) {}
		if (!mq.matches) {
			return
		}
		if (moved) {
			snapToNearest()
		} else {
			applyTransform(true)
		}
	}

	el.addEventListener("pointerdown", onPointerDown)
	el.addEventListener("pointermove", onPointerMove, ptrMoveOpts)
	el.addEventListener("pointerup", onPointerUp)
	el.addEventListener("pointercancel", onPointerUp)

	$(window).on("resize", function () {
		tx = clamp(tx)
		if (!mq.matches) {
			reset()
		} else {
			applyTransform(false)
		}
	})

	var onMqChange = function () {
		if (!mq.matches) {
			reset()
		} else {
			tx = clamp(tx)
			applyTransform(false)
		}
	}

	if (mq.addEventListener) {
		mq.addEventListener("change", onMqChange)
	} else if (mq.addListener) {
		mq.addListener(onMqChange)
	}
}

makeSwipeable(".works__blocks", {
	childSel: ".works__block",
	draggingClass: "works__swipe-dragging",
	onSnap: function (children, mid) {
		var $b = $(".works__blocks")
		var closest = 0
		var best = 1e9
		for (var i = 0; i < children.length; i++) {
			var r = children[i].getBoundingClientRect()
			var d = Math.abs(r.left + r.width * 0.5 - mid)
			if (d < best) {
				best = d
				closest = i
			}
		}
		$b.find(".works__block").removeClass("active").eq(closest).addClass("active")
		for (var j = 0; j <= 4; j++) {
			$b.removeClass("works__current-" + j)
		}
		$b.addClass("works__current-" + closest)
	},
})

makeSwipeable(".advisory__blocks", {
	childSel: ".advisory__block",
	draggingClass: "advisory__swipe-dragging",
})

var shopWeightStep = 0.5

function shopParseWeight(val) {
	var n = parseFloat(String(val).replace(",", "."))
	return isNaN(n) ? 0 : n
}

function shopRoundWeight(n) {
	return Math.round(n / shopWeightStep) * shopWeightStep
}

function shopFormatWeight(n) {
	n = shopRoundWeight(n)
	if (n % 1 === 0) {
		return String(n)
	}
	return n.toFixed(1)
}

function shopSetWeight($input, n) {
	n = Math.max(0, shopRoundWeight(n))
	$input.val(n > 0 ? shopFormatWeight(n) : "")
}

$(document).on("click", ".shop__weight-btn--minus", function () {
	var $input = $(this).closest(".shop__weight-wr").find(".shop__weight-input")
	shopSetWeight($input, shopParseWeight($input.val()) - shopWeightStep)
})

$(document).on("click", ".shop__weight-btn--plus", function () {
	var $input = $(this).closest(".shop__weight-wr").find(".shop__weight-input")
	shopSetWeight($input, shopParseWeight($input.val()) + shopWeightStep)
})

$(document).on("change blur", ".shop__weight-input", function () {
	shopSetWeight($(this), shopParseWeight($(this).val()))
})

// ===== Visitor City =====
;(function ($) {
	var CITY_LABELS = {
		moscow: "Москва",
		spb: "Санкт-Петербург"
	}

	function normalizeCityKey(key) {
		return key === "spb" ? "spb" : "moscow"
	}

	function getThemeCity() {
		var city = window.diceyTheme && window.diceyTheme.city ? window.diceyTheme.city : {}
		var key = normalizeCityKey(city.key)

		return {
			key: key,
			label: city.label || CITY_LABELS[key]
		}
	}

	function setThemeCity(city) {
		if (!window.diceyTheme) {
			window.diceyTheme = {}
		}

		var key = normalizeCityKey(city && city.key)
		window.diceyTheme.city = {
			key: key,
			label: city && city.label ? city.label : CITY_LABELS[key]
		}
	}

	function activateShippingCity(key) {
		key = normalizeCityKey(key)

		$(".shipping").each(function () {
			var $shipping = $(this)
			var $tab = $shipping.find('.shipping__tab[data-city-key="' + key + '"]').first()

			if (!$tab.length) {
				return
			}

			if (!$tab.hasClass("active")) {
				$tab.trigger("click")
				return
			}

			var index = $shipping.find(".shipping__tab").index($tab)
			$shipping.find(".standart__tabcontent").hide().removeClass("active")
			$shipping.find(".standart__tabcontent").eq(index).show().addClass("active")
		})
	}

	function applyCity(city) {
		setThemeCity(city)

		var current = getThemeCity()
		$(".header-city__label").text(current.label)
		$("body").attr("data-dicey-city", current.key)
		activateShippingCity(current.key)
	}

	window.diceyGetCityKey = function () {
		return getThemeCity().key
	}

	window.diceyApplyCity = applyCity

	$(function () {
		applyCity(getThemeCity())

		if (!window.diceyTheme || !window.diceyTheme.ajaxUrl) {
			return
		}

		$.ajax({
			url: window.diceyTheme.ajaxUrl,
			type: "POST",
			dataType: "json",
			data: { action: "dicey_detect_city" },
			success: function (res) {
				if (res && res.success && res.data) {
					applyCity(res.data)
				}
			}
		})
	})
}(jQuery))

// ===== Shipping Maps =====
;(function ($) {
    var YMAPS_KEY  = 'eee5455e-2d4c-4174-b71d-e53e2c579428';
    var DADATA_KEY = '625ac2d6e333230dfb431316f21c5024f2229a70';

    var ZONES = {};

    var state = {
        moscow: { map: null, marker: null, ready: false },
        spb:    { map: null, marker: null, ready: false }
    };

    var cfg = {
        moscow: {
            mapId: 'shipping-map-moscow', inputId: 'shipping-input-moscow',
            suggestId: 'shipping-suggest-moscow', resultId: 'shipping-result-moscow',
            center: [55.7558, 37.6173], zoom: 9,
            dadataLocations: [{ region: 'Москва' }, { kladr_id: '50' }]
        },
        spb: {
            mapId: 'shipping-map-spb', inputId: 'shipping-input-spb',
            suggestId: 'shipping-suggest-spb', resultId: 'shipping-result-spb',
            center: [59.9343, 30.3351], zoom: 9,
            dadataLocations: [{ region: 'Санкт-Петербург' }, { kladr_id: '47' }]
        }
    };

    function pointInPolygon(point, polygon) {
        var lat = point[0], lon = point[1], inside = false;
        for (var i = 0, j = polygon.length - 1; i < polygon.length; j = i++) {
            var xi = polygon[i][0], yi = polygon[i][1];
            var xj = polygon[j][0], yj = polygon[j][1];
            if ((yi > lon) !== (yj > lon) && lat < (xj - xi) * (lon - yi) / (yj - yi) + xi) {
                inside = !inside;
            }
        }
        return inside;
    }

    function isInZone(point, rings) {
        if (!rings) return false;
        return rings.some(function (ring) { return pointInPolygon(point, ring); });
    }

    function addFreeZone(coordinates, map) {
        map.geoObjects.add(new ymaps.GeoObject({
            geometry: { type: 'Polygon', coordinates: coordinates, fillRule: 'nonZero' },
            properties: { balloonContent: 'Бесплатная доставка' }
        }, {
            fillColor: '#FFBD74', strokeColor: '#FF9425',
            opacity: 0.5, strokeWidth: 3, strokeStyle: 'solid', zIndex: 2
        }));
    }

    function addPaidZone(coordinates, map) {
        map.geoObjects.add(new ymaps.GeoObject({
            geometry: { type: 'Polygon', coordinates: coordinates, fillRule: 'nonZero' },
            properties: { balloonContent: 'Платная доставка' }
        }, {
            fillColor: '#7F9FE0', strokeColor: '#326CEC',
            opacity: 0.4, strokeWidth: 3, strokeStyle: 'solid', zIndex: 1
        }));
    }

    function initMap(key) {
        var s = state[key];
        var c = cfg[key];
        if (s.ready || !document.getElementById(c.mapId)) return;
        s.ready = true;

        var map = new ymaps.Map(c.mapId, { center: c.center, zoom: c.zoom, controls: ['zoomControl'] });
        s.map = map;

        ['geolocationControl','searchControl','trafficControl','typeSelector','fullscreenControl','rulerControl']
            .forEach(function(ctrl) { try { map.controls.remove(ctrl); } catch(e) {} });

        var zones = ZONES[key];
        if (zones.paid) addPaidZone(zones.paid, map);
        if (zones.free) addFreeZone(zones.free, map);
    }

    function suggestAddress(key, query) {
        var c = cfg[key];
        if (!query || query.length < 3) { $('#' + c.suggestId).hide().empty(); return; }
        $.ajax({
            url: 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address',
            type: 'POST', contentType: 'application/json',
            headers: { Authorization: 'Token ' + DADATA_KEY },
            data: JSON.stringify({ query: query, count: 5, restrict_value: false, locations: c.dadataLocations }),
            success: function (res) { renderSuggestions(key, res.suggestions || []); }
        });
    }

    function renderSuggestions(key, suggestions) {
        var c = cfg[key];
        var $list = $('#' + c.suggestId).empty();
        if (!suggestions.length) { $list.hide(); return; }
        $.each(suggestions, function (_, s) {
            $('<div class="shipping__suggest-item">').text(s.value).on('click', function () {
                $('#' + c.inputId).val(s.value);
                $list.hide();
                var lat = s.data && parseFloat(s.data.geo_lat);
                var lon = s.data && parseFloat(s.data.geo_lon);
                if (lat && lon) { checkPoint(key, lat, lon); }
                else { $('#' + c.resultId).html('<span class="shipping__check--err">Координаты не определены</span>'); }
            }).appendTo($list);
        });
        $list.show();
    }

    function checkPoint(key, lat, lon) {
        var s = state[key];
        var c = cfg[key];
        var coords = [lat, lon];

        if (s.map) {
            if (s.marker) s.map.geoObjects.remove(s.marker);
            s.marker = new ymaps.Placemark(coords, {}, { preset: 'islands#redCircleDotIcon' });
            s.map.geoObjects.add(s.marker);
            s.map.panTo(coords, { flying: true });
        }

        var $res = $('#' + c.resultId);
        var zones = ZONES[key];
        if (isInZone(coords, zones.free)) {
            $res.html('<span class="shipping__check--ok">✓ Бесплатная доставка по вашему адресу</span>');
        } else if (isInZone(coords, zones.paid)) {
            $res.html('<span class="shipping__check--err">⚠ Адрес в платной зоне доставки</span>');
        } else {
            $res.html('<span class="shipping__check--err">✗ Адрес не входит в зону доставки</span>');
        }
    }

    function bindInputs() {
        $.each(cfg, function (key, c) {
            var timer;
            $(document).on('input', '#' + c.inputId, function () {
                var val = $(this).val();
                clearTimeout(timer);
                timer = setTimeout(function () { suggestAddress(key, val); }, 350);
            });
            $(document).on('keydown', '#' + c.inputId, function (e) {
                if (e.key === 'Escape') $('#' + c.suggestId).hide();
            });
        });
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.shipping__suggest-wr').length) {
                $('.shipping__suggest-list').hide();
            }
        });
    }

    function loadYmaps(cb) {
        if (window.ymaps) { ymaps.ready(cb); return; }
        var s = document.createElement('script');
        s.src = 'https://api-maps.yandex.ru/2.1/?apikey=' + YMAPS_KEY + '&lang=ru_RU';
        s.onload = function () { ymaps.ready(cb); };
        document.head.appendChild(s);
    }

    $(function () {
        if (!$('#shipping-map-moscow, #shipping-map-spb').length) return;
        $.ajax({
            url: (window.diceyTheme && window.diceyTheme.assetsUrl ? window.diceyTheme.assetsUrl : '') + '/js/zones.json',
            dataType: 'text',
            success: function (text) {
                ZONES = (new Function('return (' + text + ')'))();
                loadYmaps(function () {
                    initMap(window.diceyGetCityKey ? window.diceyGetCityKey() : 'moscow');
                    bindInputs();
                    $(document).on('click', '.shipping__tabs .standart__tab', function () {
                        var key = $(this).data('city-key') || 'moscow';
                        setTimeout(function () { initMap(key); }, 80);
                    });
                });
            }
        });
    });
}(jQuery));

// ===== end Shipping Maps =====

$(".shop__wr").each(function () {
	var el = this
	var $wr = $(el)
	var ptrId = null
	var startX = 0
	var startScroll = 0
	var dragging = false
	var moved = false
	var ptrMoveOpts = { passive: false }

	el.addEventListener("pointerdown", function (e) {
		if (e.pointerType !== "mouse" || e.button !== 0) {
			return
		}
		if (el.scrollWidth <= el.clientWidth) {
			return
		}
		ptrId = e.pointerId
		startX = e.clientX
		startScroll = el.scrollLeft
		dragging = true
		moved = false
	})

	el.addEventListener(
		"pointermove",
		function (e) {
			if (!dragging || e.pointerId !== ptrId) {
				return
			}
			var dx = e.clientX - startX
			if (Math.abs(dx) > 5) {
				if (!moved) {
					moved = true
					$wr.addClass("shop__wr--dragging")
					try {
						el.setPointerCapture(e.pointerId)
					} catch (err) {}
				}
			}
			if (!moved) {
				return
			}
			el.scrollLeft = startScroll - dx
		},
		ptrMoveOpts
	)

	function endDrag(e) {
		if (e.pointerId !== ptrId) {
			return
		}
		var wasMoved = moved
		dragging = false
		moved = false
		ptrId = null
		$wr.removeClass("shop__wr--dragging")
		try {
			el.releasePointerCapture(e.pointerId)
		} catch (err) {}
		if (wasMoved) {
			$wr.data("drag-moved", true)
		}
	}

	el.addEventListener("pointerup", endDrag)
	el.addEventListener("pointercancel", endDrag)
})
