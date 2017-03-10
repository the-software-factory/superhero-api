<?php

namespace AppBundle\Controller;         //DEVE COMBACIARE CON QUELLO SOTTO src

use AppBundle\Model\Superevil;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SuperheroController extends Controller            //HO CAMBIATO IL NOME
{
    /**
     * @Route("superhero/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => 'foobar',
        ]);
    }

    
    //DA QUI ABBIAMO FATTO NOI //

    /**
     * @Route("superhero/detail", name="detail")
     */

    public function detailAction(Request $request){

        $superhero= new Superhero();
        $superhero->setName('Superman');       //INCAPSULAMENTO , RICHIAMO FUNZIONE PER SCRIVERE VARIABILE PRIVATA
        $superhero->setRealName('Clark Kent');
        $superhero->setLocation('Metropolis');
        $superhero->setHasCloak(true);
        $superhero->setBirthDate('04/25/1975');

        return $this->render(
            'default/detail.html.twig',         //non abbiamo il template, lo andiamo a creare all'interno di default
            [
                'superhero'=>$superhero,
            ]
        );
    }



    /**
     * @Route("superhero/evil", name="evil")
     */
    
    public function evilAction(Request $request)
    {
        $superevil=new Superevil('Miami');
        $superevil->setName('Joker');
        $superevil->setPower('Fire');
        $superevil->setRealName('Marco');
        
        $superevil2= new Superevil('Gualdo');
        $superevil2->setName('Stregone');
        $superevil2->setRealName('Luca');
        
        return $this->render('default/evil.html.twig', [
            'evil' => $superevil,
            'evil2'=> $superevil2,
        ]);
    }
}
