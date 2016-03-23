<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

$fs = new Filesystem();
$yamlParser = new Parser();

// Getting config file
// The first argument to this script is a path to a configuration yaml file; relative to CWD.
$configFilePath = $argv[1];
$configFileDir = dirname($configFilePath);
$config = $yamlParser->parse(file_get_contents($configFilePath));
// changing working directory to where config file is, so we can use it's relative paths
chdir($configFileDir);

$loader = new Twig_Loader_Filesystem($config['src']);
// @todo Dynamically look at all folders in `$config['src']` and add them via `$loader-addPath()` so Twig knows of them.
//$loader->addPath($config['src'] . 'atoms', 'atoms');
//$loader->addPath($config['src'] . 'molecules', 'molecules');
//$loader->addPath($config['src'] . 'organisms', 'organisms');
$finder = new Finder();

$twig = new Twig_Environment($loader, array(
  'cache' => __DIR__ . '/cache', // `__DIR__` is still the directory where this file resides
));

// $config['globalData'] is an array of file paths to data files, we'll merge them all together
$globalData = array();
if (isset($config['globalData'])) {
    foreach ($config['globalData'] as $file) {
        $chunk = $yamlParser->parse(file_get_contents($file));
        $globalData = array_merge($globalData, $chunk);
    }
}

$finder->files()->in($config['src'])->name('*.twig');

foreach ($finder as $file) {
  $path = $file->getRelativePathname();
  
  $localDataPath = $config['src'] . str_replace(".twig", ".yml", $path);
  if ($fs->exists($localDataPath)) {
    $localData = $yamlParser->parse(file_get_contents($localDataPath));
    $data = array_merge($globalData,$localData);
  }
  else {
    $data = $globalData;
  }

  $template = $twig->loadTemplate($path);
  $html = $template->render($data);
  $fileDest = $config['dist'] . str_replace(".twig", ".html", $path);

  try {
    $fs->mkdir(dirname($fileDest));
    $fs->dumpFile($fileDest, $html);
  } catch (IOExceptionInterface $e) {
    echo "An error occurred while creating your directory at ".$e->getPath();
  }

}
