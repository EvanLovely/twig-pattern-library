#!/usr/local/bin/php
<?php

// Examples:
// ./compile-twig.php '@organisms/site-header-with-search.twig' '{"text": "from cli"}'
// ./compile-twig.php '@atoms/button.twig' '{"text": "from cli"}'

require_once '../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('../src');
$loader->addPath('../src/atoms', 'atoms');
$loader->addPath('../src/molecules', 'molecules');
$loader->addPath('../src/organisms', 'organisms');
$twig = new Twig_Environment($loader, array(
    'cache' => 'cache',
));

$template = $twig->loadTemplate($argv[1]);
//$template = $twig->loadTemplate('@atoms/button.twig');
$data = json_decode($argv[2], true);
//echo $template->render(array('text' => 'text from php'));
echo $template->render($data);
?>