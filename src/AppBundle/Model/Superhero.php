<?php               //QUESTO E' TUTTO CODICE SCRITTO DA NOI//
declare(strict_types=1);

namespace AppBundle\Model;
use Doctrine\ORM\Mapping as ORM;                //aggiunto da me//

/**
 * Created by PhpStorm.
 * User: riccardo
 * Date: 10/03/17
 * Time: 12.31
 */

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


    # il setter non server perche doctrine riesce da solo a valorizzarlo

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
     * @var string
     */
    private $realName;


    /**
     * @ORM\Column(name="location", type="string")
     * @var string
     */
    private $location;


    /**
     * @ORM\Column(name="has_cloak", type="boolean")
     * @var bool
     */
    private $hasCloak;


    /**
     * @ORM\Column(name="birth_date", type="datetime")
     * @var datetime
     */
    private $birthDate;



    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     *      */
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