<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarRepository")
 */
class Car
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefabriquation", type="datetime")
     */
    private $datefabriquation;

    /**
     * @var int
     *
     * @ORM\Column(name="nombredeporte", type="integer")
     */
    private $nombredeporte;
    
    
   /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="picture", referencedColumnName="id")
     * })
     */
   private $picture;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Car
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set datefabriquation
     *
     * @param \DateTime $datefabriquation
     * @return Car
     */
    public function setDatefabriquation($datefabriquation)
    {
        $this->datefabriquation = $datefabriquation;

        return $this;
    }

    /**
     * Get datefabriquation
     *
     * @return \DateTime 
     */
    public function getDatefabriquation()
    {
        return $this->datefabriquation;
    }

    /**
     * Set nombredeporte
     *
     * @param integer $nombredeporte
     * @return Car
     */
    public function setNombredeporte($nombredeporte)
    {
        $this->nombredeporte = $nombredeporte;

        return $this;
    }

    /**
     * Get nombredeporte
     *
     * @return integer 
     */
    public function getNombredeporte()
    {
        return $this->nombredeporte;
    }

   

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Car
     */
    public function setPicture(\Application\Sonata\MediaBundle\Entity\Media $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPicture()
    {
        return $this->picture;
    }
    
    public function __toString()
    {
        return $this->libelle;
    }
}
