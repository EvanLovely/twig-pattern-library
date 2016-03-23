var assert = require('assert');
var fs = require('fs');
var path = require('path');
var compile = require('../../index.js');

describe('Basics', function() {
  describe('basic-compile', function () {
    it('should compile Twig to HTML', function () {
      compile(path.join(__dirname, './basic-compile/config.yml'));
      var expected = fs.readFileSync(path.join(__dirname, './basic-compile/expected/button.html'), 'utf8');
      var actual = fs.readFileSync(path.join(__dirname, './basic-compile/dist/button.html'), 'utf8');
      assert.equal(expected, actual);
    });
  });
  describe('basic-compile-w-global-data', function () {
    it('should use global data', function () {
      compile(path.join(__dirname, './basic-compile-w-global-data/config.yml'));
      var expected = fs.readFileSync(path.join(__dirname, './basic-compile-w-global-data/expected/button.html'), 'utf8');
      var actual = fs.readFileSync(path.join(__dirname, './basic-compile-w-global-data/dist/button.html'), 'utf8');
      assert.equal(expected, actual);
    });
  });
  describe('basic-compile-w-local-data', function () {
    it('should use local data', function () {
      compile(path.join(__dirname, './basic-compile-w-local-data/config.yml'));
      var expected = fs.readFileSync(path.join(__dirname, './basic-compile-w-local-data/expected/button.html'), 'utf8');
      var actual = fs.readFileSync(path.join(__dirname, './basic-compile-w-local-data/dist/button.html'), 'utf8');
      assert.equal(expected, actual);
    });
  });
});