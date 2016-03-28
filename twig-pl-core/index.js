'use strict';
var path = require('path');
var execSync = require('child_process').execSync;

function sh (cmd) {
  return execSync(cmd, {encoding: 'utf8'});
}

module.exports = function(configFilePath) {
  var pathToCompile = path.resolve(__dirname, 'bin/compile-tpl.php');
  var command = 'php ' + path.relative(process.cwd(), pathToCompile) + ' ' + configFilePath;
  return sh(command);
};
