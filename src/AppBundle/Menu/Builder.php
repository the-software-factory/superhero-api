<?php
namespace AppBundle\Menu;
use Knp\Menu\FactoryInterface;

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