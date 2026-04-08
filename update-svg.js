const fs = require('fs');
const path = './public/maps/indonesia.svg';
let svg = fs.readFileSync(path, 'utf8');

// The 12 active provinces matching the image
const activeIds = [
  'ID-RI', 'ID-SS', 'ID-LA',
  'ID-BT', 'ID-JT', 'ID-JK', 'ID-JI',
  'ID-KB', 'ID-KT', 'ID-KS',
  'ID-SN'
];

svg = svg.replace(/ class="active"/g, '');

activeIds.forEach(id => {
  const re = new RegExp('id="' + id + '"(?![a-zA-Z0-9_-])');
  svg = svg.replace(re, 'id="' + id + '" class="active"');
});

fs.writeFileSync(path, svg);
console.log('SVG updated successfully.');
