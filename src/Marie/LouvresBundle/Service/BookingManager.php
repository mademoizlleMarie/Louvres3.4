<?php

namespace Marie\LouvresBundle\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BookingManager
{


    private $session;

    //créez une __construct()méthode avec un $sessionargument qui possède l'indicateur de type (chemin d'accès). Définissez cette $sessionpropriété sur une nouvelle propriété et utilisez-la plus tard
    public function __construct( SessionInterface $session)
    {
        $this->session = $session;
    }

    // mettre le chemin de l'entité permet de typer la variable = c'est un objet de type reservation
    public function initBooking(\Marie\LouvresBundle\Entity\reservation $reservation)
    {
        $this->session->set('reservation', $reservation);
    }

    public function getReservation()
    {
        return $this->session->get('reservation');
    }


    public function updateBooking(\Marie\LouvresBundle\Entity\reservation $reservation)
    {
        // recupérer les billets

        $tickets = $reservation->getTickets();

        $total = $this->calculPriceTotal($tickets);

        $reservation->setPrice($total);

        // faire le cacul de prix pour chaque billet

        // set le price du billet

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

        // calcul de prix en fonction de l'age, etc.....

        return $ticketPrice;
    }

}