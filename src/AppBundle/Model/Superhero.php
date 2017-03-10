<?php               //QUESTO E' TUTTO CODICE SCRITTO DA NOI//
declare(strict_types=1);

namespace AppBundle\Model;

/**
 * Created by PhpStorm.
 * User: riccardo
 * Date: 10/03/17
 * Time: 12.31
 */
class Superhero
{
    private $name;
    private $realName;
    private $location;
    private $hasCloak;
    private $birthDate;    

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * @param mixed $realName
     */
    public function setRealName($realName)              //CREATE AUTOMATICAMENTE
    {
        $this->realName = $realName;
    }

    /**
     * @return mixed
     */
    public function getHasCloak()
    {
        return $this->hasCloak;
    }
    
    /**
     * @param mixed $hasCloak
     */
    public function setHasCloak($hasCloak)
    {
        $this->hasCloak = $hasCloak;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
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
        $this->name= $name;
    }
    
}