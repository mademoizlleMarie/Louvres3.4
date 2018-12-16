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





class PaiementController extends Controller
{
     /**
     * @Route("/paiement", name="paiement")
     */
    public function paiementAction(Request $request)
    {
        $reservation = $this->get('bookingManager')->getReservation();
        $form = $this->get('form.factory')->create(reservationType::class,$reservation);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid())
        {
           return new RedirectResponse($this->generateUrl('paiement'));
        }
        return $this->render('@MarieLouvres/Default/paiement.html.twig', array(
            'form' => $form->createView(),"reservation"=>$reservation
        ));

    }

    /**
     * @Route("/checkout",name="order_checkout",methods="POST")
     */
    public function checkoutAction(Request $request)
    {
        $bookingManager = $this->get('bookingManager');
        $reservation = $bookingManager->getReservation();
        \Stripe\Stripe::setApiKey("sk_test_nMBC4BR6phi8eDmrme0Diadk");

        $token = $_POST['stripeToken'];

        try {
             \Stripe\Charge::create(array(
                "amount" => $reservation->getPrice()*100, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - OpenClassrooms Exemple"
            ));
            $this->addFlash("success","Bravo ça marche !");

            $bookingManager->payementValide();

            return $this->render('@MarieLouvres/Default/paiementok.html.twig',array(
               "reservation"=>$reservation));
        } catch(\Stripe\Error\Card $e) {

            $this->addFlash("error","Snif ça marche pas :(");
            return $this->redirectToRoute("paiement");
        }
    }
}
