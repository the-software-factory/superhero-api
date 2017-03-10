<?php
declare(strict_types=1);

namespace AppBundle\Model;

class Superhero
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $realName;

    /**
     * @var string
     */
    private $location;

    /**
     * @var bool
     */
    private $hasCloak;

    /**
     * @var \DateTime
     */
    private $birthDate;

    /**
     * @return string
     */
    public function getRealName(): string
    {
        return $this->realName;
    }

    /**
     * @param string $realName
     */
    public function setRealName(string $realName)
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
    public function hasCloak(): bool
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if (strlen($name) == 0) {
            throw new \InvalidArgumentException('Superhero name cannot be empty.');
        }

        $this->name = $name;
    }
}
