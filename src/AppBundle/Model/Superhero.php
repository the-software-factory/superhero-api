<?php
declare(strict_types=1);
/**
 * Created by IntelliJ IDEA.
 * User: diego
 * Date: 10/03/17
 * Time: 12:31
 */

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
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @ORM\Column(name="name",type="string")
     * @Assert\NotBlank(message="Name is required")
     * @var string
     */
    private $name;
    /**
     * @ORM\Column(name="real_name",type="string")
     * @Assert\NotBlank()
     * @var string
     */
    private $realName;
    /**
     * @ORM\Column(name="location",type="string")
     * @Assert\NotBlank()
     * @var string
     */
    private $location;
    /**
     * @ORM\Column(name="has_cloak",type="boolean")
     * @Assert\NotNull
     * @var bool
     */
    private $hasCloak = false;
    /**
     * @ORM\Column(name="birth_date",type="datetime")
     * @Assert\NotNull
     * @var \DateTime
     */
    private $birthDate;

    /**
     *
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
        if (strlen($name)==0){
            throw new \InvalidArgumentException('non vuota');
        }

        $this->name = $name;
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
    public function hasCloak(): ?bool
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
    public function getBirthDate()
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

}