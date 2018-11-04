<?php

namespace Marie\LouvresBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="Marie\LouvresBundle\Repository\countryRepository")
  */
class country
{

    /**
     * @ORM\OneToMany(targetEntity="Marie\LouvresBundle\Entity\ticket", mappedBy="country",cascade={"persist"})
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
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set country.
     *
     * @param string $country
     *
     * @return country
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * Get id
     *
     * @return int
     */

    public function __construct()
    {
        $this->tickets = new ArrayCollection();

    }



    /**
     * Add ticket
     *
     * @param \Marie\LouvresBundle\Entity\ticket $ticket
     *
     * @return country
     */
    public function addTicket(ticket $ticket)
    {
        $this->tickets[] = $ticket;
        $ticket->setCountry($this);

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
