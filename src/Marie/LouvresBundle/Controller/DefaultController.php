<?php

namespace Marie\LouvresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction()
    {
        return $this->render('@MarieLouvres/Default/information.html.twig');
    }
    /**
     * @Route("/", name="reservation")
     */
    public function reservationAction()
    {
        return $this->render('@MarieLouvres/Default/reservation.html.twig');
    }
    /**
     * @Route("/", name="paiement")
     */
    public function paiementAction()
    {
        return $this->render('@MarieLouvres/Default/paiement.html.twig');
    }
}