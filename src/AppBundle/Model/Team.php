<?php
/**
 * Created by PhpStorm.
 * User: uby
 * Date: 15/03/17
 * Time: 15.08
 */
namespace AppBundle\Model;
/**
 * @ORM\Entity()
 */
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
class Team
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="AppBundle\Model\Superhero", mappedBy="team_id")
     * @var ArrayCollection
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="hq", type="string")
     * @var string
     */
    private $hq;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return string
     */
    public function getHq()
    {
        return $this->hq;
    }
    /**
     * @param string $hq
     */
    public function setHq($hq)
    {
        $this->hq = $hq;
    }
}