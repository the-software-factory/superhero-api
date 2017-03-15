<?php
namespace AppBundle\Menu;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
/**
 * Created by PhpStorm.
 * User: bledi
 * Date: 15/03/2017
 * Time: 14:31
 */
class Builder
{
    public function mainMenu(FactoryInterface $factory, array $options){

        $menu = $factory->createItem('root');
        $menu->addChild('All Hero', ['route'=>'allHero']);
        //$menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Prova', ['route'=>'allHero']);
        $menu['Prova']->addChild('SubMenu', ['route'=>'allHero']);
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        return $menu;
    }
}