<?php

namespace Phase2\TwigPlBundle\Utils;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class Compiler
{
    private $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
        \Twig_Autoloader::register();
    }

    public function compile()
    {

        return 'hello';

//        $srcPath = __DIR__ . '/../../../../patterns';
//
//        $fs = new Filesystem();
//        $yamlParser = new Parser();
//        $loader = new Twig_Loader_Filesystem($srcPath);
//        $loader->addPath($srcPath . 'atoms', 'atoms');
//        $loader->addPath($srcPath . 'molecules', 'molecules');
//        $loader->addPath($srcPath . 'organisms', 'organisms');
//        $finder = new Finder();
//        $twig = new Twig_Environment($loader, array(
//          'cache' => './cache',
//        ));
//
//        $globalData = $yamlParser->parse(file_get_contents(__DIR__ . '/../patterns/data/data.yml'));
//
//        $finder->files()->in(__DIR__ . '/../patterns')->name('*.twig');
//
//        foreach ($finder as $file) {
//            $path = $file->getRelativePathname();
//
//            $localDataPath = $srcPath.str_replace(".twig", ".yml", $path);
//            if ($fs->exists($localDataPath)) {
//                $localData = $yamlParser->parse(file_get_contents($localDataPath));
//                $data = array_merge($globalData,$localData);
//            }
//            else {
//                $data = $globalData;
//            }
//
//            $template = $twig->loadTemplate($path);
//            $html = $template->render($data);
//            $fileDest = '../dist/' . str_replace(".twig", ".html", $path);
//
//            try {
//                $fs->mkdir(dirname($fileDest));
//                $fs->dumpFile($fileDest, $html);
//            } catch (IOExceptionInterface $e) {
//                echo "An error occurred while creating your directory at ".$e->getPath();
//            }
//
//        }
    }
}
