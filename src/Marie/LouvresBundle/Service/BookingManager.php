<?php

namespace Marie\LouvresBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Marie\LouvresBundle\Entity\ticket;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Marie\LouvresBundle\Entity\reservation;


class BookingManager
{
    private $session;
    private $em;
    
    const REDUCE_PRICE = 10;

    //créez une __construct()méthode avec un $sessionargument qui possède l'indicateur de type (chemin d'accès). Définissez cette $sessionpropriété sur une nouvelle propriété et utilisez-la plus tard
    public function __construct( SessionInterface $session, EntityManagerInterface $em) // injecter l'entity manager
    {
       $this->session = $session;
       $this->em      = $em;
    }

    // mettre le chemin de l'entité permet de typer la variable = c'est un objet de type reservation
    public function initBooking(reservation $reservation)
    {
        $this->session->remove("reservationId");
        $this->session->set('reservation', $reservation);

    }

    public function getReservation()
    {
        // Je recupere la valeur de la methode getReservationId dans l'objet booking manager et vérifie que la valeur existe
        if ( $id = $this->getReservationId())
        {
            return $this->em->getRepository(Reservation::class)->find($id);
        } else {  //sinon je fais un find dans la bdd via doctrine*/
            return $this->session->get('reservation');
        }
    }

    public function updateBooking(reservation $reservation)
    {
        $tickets = $reservation->getTickets();
        $total   = $this->calculPriceTotal($tickets);
        $payment = $reservation->getPayment()=== false;
        $code    = $reservation->getNumberofticket().$reservation->getName().date("YmdHis");

        $reservation->setPrice($total)->setPayment($payment)->setCode($code);
        // On boucle sur les tickets pour les lier à la reservation
        foreach ($tickets as $ticket){
            $reservation->addTicket($ticket);
        }
        return $reservation;
    }


    public function calculPriceTotal($tickets)
    {
        $total = 0;
        foreach($tickets as $ticket) {
            $total += $this->calculPriceTicket($ticket);
        }
        return $total;
    }

    public function calculPriceTicket($ticket)
    {
        // if price reduced
        if($ticket->getReduced() === true) {
            $price = BookingManager::REDUCE_PRICE;
        } else { // standard price ticket
            $price = $ticket->getPrice();
        }
        // if half day
        if($ticket->getDescription() === 'half day ticket') $price = $price/2;

        return $price;
    }

    public function setReservationId($id)
    {
        $this->session->set('reservationId', $id);
    }

    public function getReservationId()
    {
       if (!$id = $this->session->get('reservationId')) return null;
       return $id;
    }

    public function payementValide()
    {
        $reservation = $this->getReservation();
        $reservation->setPayment(1);
        $em = $this->em;
        $em->persist($reservation);
        $em->flush();
    }

    public function mailerAction(reservation $reservation, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message())
            ->setFrom('sylvestre.marie@gmail.com')
            ->setTo($reservation->getEmail())
            ->setSubject('Votre e-billet pour l\'entrée du musée du Louvre')
            ->setBody($this->renderView('@MarieLouvres/Default/mail.html.twig',['tickets' => $reservation->getTickets()]),'text/html');

        $mailer->send($message);
    }


}



