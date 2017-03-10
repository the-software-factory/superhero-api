<?php
declare(strict_types=1);

namespace AppBundle\Model;

use Symfony\Component\Serializer\Tests\Model;

class Superhero
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var $string
     */
    private $realName;

    /**
     * @var string
     */
    private $location;

    /**
     * @var boolean
     */
    private $hasCloak;
    /**
     * @var \DateTime
     */
    private $birthDate;

    /**
     * @return mixed
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
