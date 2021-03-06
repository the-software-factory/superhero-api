<?php
declare(strict_types=1);

namespace AppBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Superhero
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank(message="Name is required")
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="real_name", type="string")
     * @Assert\NotBlank
     * @var string
     */
    private $realName;

    /**
     * @ORM\Column(name="location", type="string")
     * @Assert\NotBlank
     * @var string
     */
    private $location;

    /**
     * @ORM\Column(name="has_cloak", type="boolean")
     * @Assert\NotNull
     * @var bool
     */
    private $hasCloak = false;

    /**
     * @ORM\Column(name="birth_date", type="datetime")
     * @Assert\NotNull
     * @var \DateTime
     */
    private $birthDate;

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
    public function getRealName(): ?string
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
    public function getBirthDate(): ?\DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(?\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getName(): ?string
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
