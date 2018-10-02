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

    var_dump($ticket);
    if ($ticket->$dateofbirth < (new \DateTime('now')))
           {$ticketPrice = 4;}
    else {$ticketPrice = 5;}

        // si ($datedenaissance=datetime-nrbe jours (mineurs) and + de 4ans  and billet demi-journée
        //  alors ($ticketPrice = "4")
        // si ($datedenaissance=datetime-nrbe jours (mineurs) and + de 4ans  and billet journée
        // alors $ticketPrice = "8"
        // si ($datedenaissance=datetime-nrbe jours (entre majeur et 59 ans) and reduce  and billet demi-journée
        // alors $ticketPrice = "5"
        // si ($datedenaissance=datetime-nrbe jours (entre majeur et 59 ans) and reduce  and billet journée
        // alors $ticketPrice = "10"
        //si ($datedenaissance=datetime-nrbe jours (entre majeur et 59 ans) and pas de reduce  and billet demi-journée
        // alors $ticketPrice = "8"
        // si ($datedenaissance=datetime-nrbe jours (entre majeur et 59 ans) and pas de reduce  and billet journée
        // alors $ticketPrice = "16"
        //si ($datedenaissance=datetime-nrbe jours (+60)  and billet demi-journée
        // alors $ticketPrice = "6"
        // si ($datedenaissance=datetime-nrbe jours (+60)  and billet journée
        // alors $ticketPrice = "12"

        return $ticketPrice;
    }

}