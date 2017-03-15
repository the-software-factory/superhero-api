<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;

/**
 * Created by PhpStorm.
 * User: riccardo
 * Date: 15/03/17
 * Time: 13.19
 */


class Builder
{
    public function mainMenu(FactoryInterface $factory, array $options){
        $menu=$factory->createItem('root');
        $menu->addChild('All Hero', ['route' => 'allHero']);
        $menu->addChild('All Team', ['route' => 'homepage_team']);
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        return $menu;

    }
}