<?php

namespace Marie\LouvresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Marie\LouvresBundle\Validator\Constraints\ConstraintDateOfBirth;
/**
 * ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="Marie\LouvresBundle\Repository\ticketRepository")

 */
class ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Marie\LouvresBundle\Entity\reservation", inversedBy="tickets", cascade = {"persist"})
     *
     *
     */
    private $reservation;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     * @Assert\Type(type="string")
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit comprendre au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne doit pas comprendre plus {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit comprendre au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne doit pas comprendre plus {{ limit }} caractères"
     * )
     */
    private $firstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofbirth", type="datetime")
     * @Assert\Date(message = "Vous devez entrer une date valide.")
     * @ConstraintDateOfBirth()
     *
     */
    private $dateofbirth;

    /**
     * @var bool
     *
     * @ORM\Column(name="reduced", type="boolean")
     * @Assert\Type("bool")
     */
    private $reduced;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\Type("string")
     */
    private $description;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ticket
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return ticket
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set dateofbirth
     *
     * @param \DateTime $dateofbirth
     *
     * @return ticket
     */
    public function setDateofbirth($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * Get dateofbirth
     *
     * @return \DateTime
     */
    public function getDateofbirth()
    {
        return $this->dateofbirth;
    }



    /**
     * Set reduced
     *
     * @param boolean $reduced
     *
     * @return ticket
     */
    public function setReduced($reduced)
    {
        $this->reduced = $reduced;
        var_dump($reduced);
        return $this;
    }

    /**
     * Get reduced
     *
     * @return bool
     */
    public function getReduced()
    {
        return $this->reduced;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ticket
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set reservation
     *
     * @param \Marie\LouvresBundle\Entity\reservation $reservation
     *
     * @return ticket
     */
    public function setReservation(\Marie\LouvresBundle\Entity\reservation $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Marie\LouvresBundle\Entity\reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }



}
