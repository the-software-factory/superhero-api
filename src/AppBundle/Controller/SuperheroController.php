<?php

namespace AppBundle\Controller;         //DEVE COMBACIARE CON QUELLO SOTTO src

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
     * @Route("/detail", name="detail")
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
}
