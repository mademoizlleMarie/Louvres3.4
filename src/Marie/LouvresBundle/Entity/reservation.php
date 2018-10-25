<?php

namespace Marie\LouvresBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;

/**
 * reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="Marie\LouvresBundle\Repository\ReservationRepository")
 */
class reservation
{
    // l'entité reservation porte la relation One (reservation) to Many (tickets) afin de permettre d'avoir un tableau d'objet de ticket
    /**
     * @ORM\OneToMany(targetEntity="Marie\LouvresBundle\Entity\ticket", mappedBy="reservation",cascade={"persist"})
    */
    private $tickets; // une réservation est lié à plusieurs tickets

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     *
     */
    private $date;

    /**
     * @var  int
     *
     * * @ORM\Column(name="numberofticket", type="integer")
     *
     */
    private $numberofticket;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */

    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255,nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="payment", type="boolean")
     */
    private $payment;


    /**
     * Get id
     *
     * @return int
     */

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->date = new \Datetime();
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return reservation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set numberofticket
     *
     * @param integer %numberofticket
     *
     * @return reservation
     */
    public function setNumberofticket($numberofticket)
    {
        $this->numberofticket = $numberofticket;

        return $this;
    }

    /**
     * Get numberofticket
     *
     * @return int
     */
    public function getNumberofticket()
    {
        return $this->numberofticket;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return reservation
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return reservation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return reservation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set payment
     *
     * @param boolean $payment
     *
     * @return reservation
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return bool
     */
    public function getPayment()
    {
        return $this->payment;
    }




    /**
     * Add ticket
     *
     * @param \Marie\LouvresBundle\Entity\ticket $ticket
     *
     * @return reservation
     */
    public function addTicket(ticket $ticket)
    {
        $this->tickets[] = $ticket;
        // on lie le ticket à la réservation
        $ticket->setReservation($this);

        return $this;
    }

    /**
    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}
