<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 15/03/17
 * Time: 14:31
 */

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;

class Builder
{
    public function mainMenu(FactoryInterface $factory, array $options){
        $menu=$factory->createItem('root');
        $menu->addChild('All Hero',['route'=>'allHero']);
        $menu->addChild('Prova',['route'=>'allHero']);
        $menu['Prova']->addChild('SubMenu',['route'=>'allHero']);
        $menu
            ->setChildrenAttribute('class', 'nav navbar-nav');
        return $menu;
}


}