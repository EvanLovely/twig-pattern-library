#!/usr/bin/env node
'use strict';
var compile = require('./index.js');
var configFilePath = process.argv[2];
if (!configFilePath) {
  console.log('A path to a yaml configuration file is required as first argument');
  process.exit(1);
}
var output = compile(configFilePath);
console.log(output);
