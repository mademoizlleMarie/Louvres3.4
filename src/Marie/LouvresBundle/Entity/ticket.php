<?php

namespace Marie\LouvresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="Marie\LouvresBundle\Repository\ticketRepository")

 */
class ticket
{
    /**
     * @ORM\ManyToOne(targetEntity="Marie\LouvresBundle\Entity\reservation", inversedBy="tickets")
     * @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     */
    private $reservation;

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofbirth", type="datetime")
     */
    private $dateofbirth;

    /**
     * @var bool
     *
     * @ORM\Column(name="reduced", type="boolean")
     */
    private $reduced;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
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

    public function getAge()
    {

        $birthday = $this->getDateofbirth();
        $currentDay = date('Y-m-d');

        $diff = 20; //$currentDay - $birthday;

        return $diff;

    }
    private $params = [
        ['from' => 0, 'to' => 4, 'category' => 'BABY'],
        ['from' => 4, 'to' => 12, 'category' => 'CHILD'],
        ['from' => 12, 'to' => 60, 'category' => 'NORMAL'],
        ['from' => 60, 'to' => 200, 'category' => 'SENIOR'],
    ];

    private $prices = [
        'BABY' => 0,
        'CHILD' => 8,
        'NORMAL' => 16,
        'SENIOR' => 12,
    ];

    public function getPrice()
    {

        return $this->prices['category'];
    }

    public function getCategory()
    {
        $params = $this->params;
        $age = $this->getAge(); // return 3 or 11
        foreach($params as $param)
        {
            if( $age >= $param['from'] && $age < $param['to']) $category = $param['category'];
        }

        /*
        if( $age >= 0 && $age < 4) 	 $category = 'BABY';
        if( $age >  4 && $age < 12)  $category = 'CHILD';
        if( $age > 12 && $age < 60)  $category = 'NORMAL';
        if( $age > 60 && $age < 200) $category = 'SENIOR';
        */

        return $category;


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
}
