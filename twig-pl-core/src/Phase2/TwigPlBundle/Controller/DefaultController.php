<?php

namespace Phase2\TwigPlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function compile()
    {
        return $this->render(
          ':test:test.html.twig',
          array('data' => '')
        );
    }
}
