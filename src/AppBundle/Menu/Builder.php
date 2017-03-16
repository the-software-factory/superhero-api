<?php
/**
 * Created by PhpStorm.
 * User: lorenzo
 * Date: 15/03/17
 * Time: 14.31
 */

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;

class Builder
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('All Heroes', ['route' => 'allHeroes']);
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Prova', ['route' => 'allHeroes']);
        $menu['Prova']->addChild('SubMenu', ['route' => 'allHeroes']);
        $menu->setChildrenAttribute('class', 'nav navbar-nav');


        return $menu;
    }
}