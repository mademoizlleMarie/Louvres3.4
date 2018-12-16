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


class ReservationController extends Controller
{


    /**
     * @Route("/reservation", name="reservation")
     */
    public function reservationAction(Request $request)
    {
        $bookingManager = $this->get('bookingManager');
        $reservation = $bookingManager->getReservation();
        $form = $this->get('form.factory')->create(reservationTicketType::class, $reservation);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $reservation = $bookingManager->updateBooking($reservation);
            $em->persist($reservation);
            $em->flush();
            $bookingManager->setReservationId($reservation->getId());

            return new RedirectResponse($this->generateUrl('paiement'));
        }
        return $this->render('@MarieLouvres/Default/reservation.html.twig', array(
            'form' => $form->createView(), "reservation" => $reservation
        ));
    }

}