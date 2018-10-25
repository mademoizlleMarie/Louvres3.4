<?php

namespace Marie\LouvresBundle\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Marie\LouvresBundle\Entity\ticket;

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
        //calcul prix
        $total = $this->calculPriceTotal($tickets);
        //pas defaut payement à false
        $payment = $reservation->getPayment()=== false;
        // le code du billet revoir comment faire pour faire un code complet
        $code = $reservation->getNumberofticket();
        $reservation->setPrice($total)->setPayment($payment)->setCode($code);

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


    const REDUCE_PRICE = 10;


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

}



