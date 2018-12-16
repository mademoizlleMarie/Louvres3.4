<?php

namespace Marie\LouvresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Marie\LouvresBundle\Entity\reservation;
use Marie\LouvresBundle\Entity\ticket;
use Marie\LouvresBundle\Form\reservationType;
use Marie\LouvresBundle\Form\reservationTicketType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Marie\LouvresBundle\Service\BookingManager;





class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $reservation = new reservation();
        $form = $this->get('form.factory')->create(reservationType::class,$reservation);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid())
        {
            $bookingManager = $this->get('BookingManager');
            $bookingManager->initBooking($reservation);

            return new RedirectResponse($this->generateUrl('reservation'));
        }

        return $this->render('@MarieLouvres/Default/accueil.html.twig', array(
            'form' => $form->createView(),));
    }
}
