<?php
/**
 * Created by PhpStorm.
 * User: riccardo
 * Date: 10/03/17
 * Time: 16.44
 */
declare(strict_types=1);

namespace AppBundle\Model;

class Superevil{
    public $town;
    private $name;
    private $realName;
    private $power;

    /**
     * Superevil constructor.
     * @param $town
     */
    public function __construct($town)
    {
        $this->town = $town;
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
     * @return mixed
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * @param mixed $realName
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;
    }

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }
}

