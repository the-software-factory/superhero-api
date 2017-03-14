<?php
declare(strict_types=1);

namespace AppBundle\Model;

use Symfony\Component\Serializer\Tests\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */

class Superhero
{
    //specifico la chiave primaria con l'annotazione \Id
    //specifico il modo con cui viene generato l'id
    //la costante auto va scritta maiuscola
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    //il setter non serve perche doctrine lo mette come settabile in automatico usando la reflection
    // cosi siamo sicuri
    //che nessuno lo possa cambiare ma cosi solo doctrine lo puo cambiare
    private $id;
    /**
     * @ORM\Column(name="name", type="string")
     * @var string
     * @Assert\NotBlank(message="Name is required")
     */
    private $name;
    /**
     * @ORM\Column(name="real_name", type="string")
     * @var $string
     * @Assert\NotBlank(message="Real Name is required")
     */
    private $realName;
    /**
     * @ORM\Column(name="location", type="string")
     * @var string
     * @Assert\NotBlank(message="Location is required")
     */
    private $location;
    /**
     * @ORM\Column(name="has_cloak", type="boolean")
     * @var boolean
     *
     */
    private $hasCloak = false;
    /**
     * @ORM\Column(name="birth_date", type="datetime")
     * @var \DateTime
     * @Assert\NotBlank(message="Birth Date in required")
     */
    private $birthDate;
    /**
     * @ORM\Column(name="picture", type="string")
     */
    private $picture;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getRealName(): ?string
    {
        return $this->realName;
    }

    /**
     * @param string $realName
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;
    }

    /**
     * @return string
     */
    public function getName(): ?string
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
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    /**
     * @return bool
     */
    public function isHasCloak(): bool
    {
        return $this->hasCloak;
    }

    /**
     * @param bool $hasCloak
     */
    public function setHasCloak(bool $hasCloak)
    {
        $this->hasCloak = $hasCloak;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }
}
