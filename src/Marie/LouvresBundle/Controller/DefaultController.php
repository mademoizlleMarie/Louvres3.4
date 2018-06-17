<?php

namespace Marie\LouvresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/",)
     */
    public function indexAction()
    {
        return $this->render('@MarieLouvres/Default/information.html.twig');
    }
}
