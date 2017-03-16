<?php
/**
 * Created by PhpStorm.
 * User: lorenzo
 * Date: 15/03/17
 * Time: 15.07
 */

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Team
 * @package AppBundle\Model
 * @ORM\Entity()
 */
class Team
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="AppBundle\Model\Superhero", mappedBy="team_id")
     * @var Array
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
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getHq(): string
    {
        return $this->hq;
    }

    /**
     * @param string $hq
     */
    public function setHq(string $hq)
    {
        $this->hq = $hq;
    }
}