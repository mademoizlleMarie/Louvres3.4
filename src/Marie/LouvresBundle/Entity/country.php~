<?php

namespace Marie\LouvresBundle\Entity;

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
     * @ORM\ManyToOne(targetEntity="Marie\LouvresBundle\Entity\ticket")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ticket;

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
     * Set ticket
     *
     * @param \Marie\LouvresBundle\Entity\ticket $ticket
     *
     * @return reservation
     */
    public function setTicket(\Marie\LouvresBundle\Entity\ticket $ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Marie\LouvresBundle\Entity\ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
