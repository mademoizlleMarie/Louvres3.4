<?php

namespace Marie\LouvresBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Marie\LouvresBundle\Validator\Constraints\ConstraintTicketJourFerie;
use Marie\LouvresBundle\Validator\Constraints\ConstraintTicket;
use Marie\LouvresBundle\Validator\Constraints\ConstraintTicketMardi;




/**
 * reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="Marie\LouvresBundle\Repository\ReservationRepository")
 */
class reservation
{
    /**
     * @ORM\OneToMany(targetEntity="Marie\LouvresBundle\Entity\ticket", mappedBy="reservation",cascade={"persist"})
    */
    private $tickets;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string")
     * @Assert\Type("string")
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     * @Assert\Date(message = "Vous devez entrer une date valide.")
     * @ConstraintTicket()
     * @ConstraintTicketJourFerie()
     * @ConstraintTicketMardi()
     *
     */
    private $date;

    /**
     * @var  int
     *
     * @ORM\Column(name="numberofticket", type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Vous devez commander au moins {{ limit }} billet",
     *      maxMessage = "Vous ne pouvez pas commander plus de {{ limit }} billets"),
     *
     * @Assert\Type(
     *     type="integer",
     *     message="Le nombre de billets entré doit être un chiffre.")
     *
     */
    private $numberofticket;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     * @Assert\Type("float")
     */

    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255,nullable=true)
     * @Assert\Length(min = 3 ,minMessage = "Votre prénom doit comporter au moins {{ limit }} caractères.")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\Email(
     *     message = "Votre Email '{{ value }}' n'est pas valide.",
     *     checkMX = true)
     *
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="payment", type="boolean")
     * @Assert\Type("bool")
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
     * @param string $code
    */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string
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
