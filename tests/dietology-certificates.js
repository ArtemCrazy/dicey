const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');
const path = require('node:path');

const registered = {};
const wp = {
  blocks: { registerBlockType: (name, config) => { registered[name] = config; } },
  element: { Fragment: 'Fragment', createElement: (type, props, ...children) => ({ type, props: props || {}, children: children.flat(Infinity) }) },
  components: Object.fromEntries(['TextControl', 'TextareaControl', 'PanelBody', 'Button'].map(name => [name, name])),
  i18n: { __: text => text },
  data: { select: () => ({ getMedia: () => null, getBlocks: () => [] }) },
  blockEditor: { MediaUpload: 'MediaUpload', MediaUploadCheck: 'MediaUploadCheck' },
};
vm.runInNewContext(fs.readFileSync(path.join(__dirname, '../public_html/wp-content/themes/dicey/blocks/index.js'), 'utf8'), { window: { wp }, console });
const editor = registered['dicey/dietology'];
let attrs = { plan_certificates: [{ image: '717' }, { image: '718' }] };
function all(node) {
  return node && typeof node === 'object' ? [node, ...node.children.flatMap(all)] : [];
}
function render() {
  return all(editor.edit({ attributes: attrs, setAttributes: patch => Object.assign(attrs, JSON.parse(JSON.stringify(patch))) }));
}
function click(label, index = 0) {
  const button = render().filter(node => node.type === 'Button' && node.children.includes(label))[index];
  assert.ok(button, label);
  assert.ok(!button.props.disabled, label + ' should be enabled');
  button.props.onClick();
}
function ids() { return attrs.plan_certificates.map(item => item.image); }

for (let i = 0; i < 6; i++) click('Добавить сертификат');
assert.equal(ids().length, 8, 'List must grow beyond two images');
assert.deepEqual(ids().slice(0, 2), ['717', '718'], 'Existing certificates must survive adding');
// The first upload control belongs to the hero, the next six to consultation icons,
// including an optional mobile icon; identify certificate controls via their panels.
function certificatePanel(number) { return render().find(node => node.type === 'PanelBody' && node.props.title === 'Сертификат ' + number); }
let upload = all(certificatePanel(3)).find(node => node.type === 'MediaUpload');
upload.props.onSelect({ id: 999 });
assert.equal(ids()[2], '999', 'Replacement saves the media-library ID');
click('Выше', 2);
assert.deepEqual(ids().slice(0, 3), ['717', '999', '718']);
click('Ниже', 1);
assert.deepEqual(ids().slice(0, 3), ['717', '718', '999']);
click('Удалить сертификат', 1);
assert.deepEqual(ids().slice(0, 2), ['717', '999']);
while (ids().length) click('Удалить сертификат');
attrs = JSON.parse(JSON.stringify(attrs));
assert.equal(render().filter(node => node.type === 'PanelBody' && /^Сертификат \d+$/.test(node.props.title)).length, 0, 'Saved empty list must not restore defaults');
click('Добавить сертификат');
assert.deepEqual(ids(), [''], 'An empty list can receive a new certificate');
attrs = {};
assert.ok(certificatePanel(1) && certificatePanel(2), 'Legacy pages without the attribute retain defaults');
console.log('PASS: certificate add, replace, reorder, delete, empty-list persistence and legacy defaults');
