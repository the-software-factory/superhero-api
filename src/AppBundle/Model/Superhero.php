<?php
declare(strict_types=1);

namespace AppBundle\Model;

use Symfony\Component\Serializer\Tests\Model;
use Doctrine\ORM\Mapping as ORM;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(name="name", type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="real_name", type="string")
     * @var $string
     */
    private $realName;

    /**
     * @ORM\Column(name="location", type="string")
     * @var string
     */
    private $location;

    /**
     * @ORM\Column(name="has_cloak", type="boolean")
     * @var boolean
     */
    private $hasCloak;

    /**
     * @ORM\Column(name="birth_date", type="datetime")
     * @var \DateTime
     */
    private $birthDate;

    /**
     * @return string
     */
    public function getRealName()
    {
        return $this->realName;
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
     * @param mixed $realName
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;
    }

    /**
     * @return string
     */
    public function getLocation(): string
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
    public function getBirthDate(): \DateTime
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

    //generate a string value from the boolean hasCloak
    /**
     * @return string
     */
    public function hasCloakToString() : string{
        if($this->hasCloak == true)
            return "Has cloak";
        else
            return "Hasn't cloak";
    }
}
