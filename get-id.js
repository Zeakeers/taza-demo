const fs = require('fs');
const svg = fs.readFileSync('./public/maps/indonesia.svg', 'utf8');

const regex = /title="([^"]+)"\s+id="([^"]+)"/g;
let match;
while ((match = regex.exec(svg)) !== null) {
  console.log(match[2] + ' = ' + match[1]);
}
