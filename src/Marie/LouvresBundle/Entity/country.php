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
}
