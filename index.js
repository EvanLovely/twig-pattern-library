'use strict';
const Twig = require('twig');
const twig = Twig.twig;
const path = require('path');
const fs = require('fs-extra');
const glob = require('glob');
const execSync = require('child_process').execSync;

const config = {
  dir: {
    src: './src/',
    dist: './dist'
  }
};

const globalData = require('./src/data/data.json');

function sh (cmd) {
  return execSync(cmd, {encoding: 'utf8'});
}

fs.emptyDirSync(config.dir.dist);

glob.sync('**/*.twig', {
  cwd: config.dir.src
}).forEach((file) => {
  let jsonPath = path.join(config.dir.src, file.replace('twig', 'json'));
  fs.readFile(jsonPath, 'utf8', (err, localData) => {
    // ok if no file there
    let data = {};
    Object.assign(data, globalData);
    if (localData) {
      Object.assign(data, JSON.parse(localData));
    }
    
    let html = sh(`./bin/compile-twig.php ${file} '${JSON.stringify(data)}'`);
    
    //let html = twig({
    //  namespaces: {
    //    atoms: './src/atoms/',
    //    molecules: './src/molecules/',
    //    organisms: './src/organisms/'
    //  },
    //  data: fs.readFileSync(path.join(config.dir.src, file), 'utf8')
    //}).render(data);

    let newFilePath = path.join(config.dir.dist, file.replace('twig', 'html'));

    fs.mkdirsSync(path.dirname(newFilePath));
    fs.writeFileSync(newFilePath, html);
  });
});
