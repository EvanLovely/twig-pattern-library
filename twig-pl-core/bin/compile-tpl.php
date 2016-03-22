<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

$srcPath = __DIR__.'/../src/';

$fs = new Filesystem();
$yamlParser = new Parser();
$loader = new Twig_Loader_Filesystem($srcPath);
$loader->addPath($srcPath . 'atoms', 'atoms');
$loader->addPath($srcPath . 'molecules', 'molecules');
$loader->addPath($srcPath . 'organisms', 'organisms');
$finder = new Finder();
$twig = new Twig_Environment($loader, array(
  'cache' => './cache',
));

$globalData = $yamlParser->parse(file_get_contents(__DIR__.'/../src/data/data.yml'));

$finder->files()->in(__DIR__.'/../src')->name('*.twig');

foreach ($finder as $file) {

  $path = $file->getRelativePathname();
  $template = $twig->loadTemplate($path);
  $html = $template->render($globalData);
  $fileDest = '../dist/' . str_replace(".twig", ".html", $path);

  try {
    $fs->mkdir(dirname($fileDest));
    $fs->dumpFile($fileDest, $html);
  } catch (IOExceptionInterface $e) {
    echo "An error occurred while creating your directory at ".$e->getPath();
  }

}

?>