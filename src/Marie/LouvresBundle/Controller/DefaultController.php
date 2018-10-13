<?php

namespace Marie\LouvresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Marie\LouvresBundle\Entity\reservation;
use Marie\LouvresBundle\Form\reservationType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Marie\LouvresBundle\Service\BookingManager;




class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction(Request $request)
    {
        // On crée un objet
        $reservation = new reservation();
        $form = $this->get('form.factory')->create(reservationType::class,$reservation);
        // cela peut être raccourci de cette facon : $form = $this->create(reservationType::class,$reservation);


        // Si la requête est en POST
        if ($request->isMethod('POST'))
        {
            $bookingManager = $this->get('BookingManager');


            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $reservation contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            if ($form->isValid())
            {
                // la reservation est valide, on la stocke en session
                $bookingManager->initBooking($reservation);

                // On redirige vers la page de réservation
                return new RedirectResponse($this->generateUrl('reservation'));
            }
        }
        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('@MarieLouvres/Default/accueil.html.twig', array(
            'form' => $form->createView(),));
    }

    /**
     * @Route("/reservation", name="reservation")
     */
    public function reservationAction(Request $request)
    {
        $bookingManager = $this->get('bookingManager');

        $reservation = $bookingManager->getReservation();

        $form = $this->get('form.factory')->create(reservationType::class,$reservation);
        var_dump($reservation);


        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if ($form->isValid())
            {
$datas=$form->getData();
var_dump($datas);
var_dump($reservation);

                $bookingManager->updateBooking($reservation);

                //$em = $this->getDoctrine()->getManager();
                //$reservation = $bookingManager->updateBooking($reservation);
                //$em->persist($reservation);
                //$em->flush();

                return new RedirectResponse($this->generateUrl('paiement'));
            }
        }
        return $this->render('@MarieLouvres/Default/reservation.html.twig', array(
            'form' => $form->createView(), "reservation"=>$reservation
        ));

     }


    /**
     * @Route("/paiement", name="paiement")
     */
    public function paiementAction(Request $request)
    {
        $reservation = new reservation();
        $bookingManager = $this->get('bookingManager');

        $reservation = $bookingManager->getReservation();

        $form = $this->get('form.factory')->create(reservationType::class,$reservation);
        var_dump($reservation);


        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if ($form->isValid())
            {
                //$em = $this->getDoctrine()->getManager();
                //$reservation = $bookingManager->updateBooking($reservation);
                //$em->persist($reservation);
                //$em->flush();

                return new RedirectResponse($this->generateUrl('paiement'));
            }
        }
        return $this->render('@MarieLouvres/Default/paiement.html.twig', array(
            'form' => $form->createView(),"reservation"=>$reservation
        ));

    }
}