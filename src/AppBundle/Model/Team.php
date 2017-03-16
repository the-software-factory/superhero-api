<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 15/03/17
 * Time: 15:07
 */

namespace AppBundle\Model;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 */
class Team
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(name="name",type="string")
     * @var
     */
    private $name;
    /**
     * @ORM\Column(name="hq", type="string")
     * @var
     */
    private $hq;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Model\Superhero",mappedBy="team")
     */
    private $heros;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->heros = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getHq()
    {
        return $this->hq;
    }

    /**
     * @param mixed $hq
     */
    public function setHq($hq)
    {
        $this->hq = $hq;
    }

    /**
     * Add hero
     *
     * @param \AppBundle\Model\Superhero $hero
     *
     * @return Team
     */
    public function addHero(\AppBundle\Model\Superhero $hero)
    {
        $this->heros[] = $hero;

        return $this;
    }

    /**
     * Remove hero
     *
     * @param \AppBundle\Model\Superhero $hero
     */
    public function removeHero(\AppBundle\Model\Superhero $hero)
    {
        $this->heros->removeElement($hero);
    }

    /**
     * Get heros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeros()
    {
        return $this->heros;
    }


}
