<?php

//il namespace deve combaciare con la struttura delle cartelle
namespace AppBundle\Controller;

use AppBundle\Model\HeroList;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//rotta di base, cioe tutte le altre devono avere questa prima
/**
 * @Route("superhero")
 */

class SuperheroController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $superheroes = array(
            $superhero = new Superhero(),
        );
        $heroList = new HeroList($superheroes);
        $superhero->setName('Superman');
        $superhero->setRealName('Clark Kent');
        $superhero->setLocation('Metropolis');
        $superhero->setHasCloak(true);
        $superhero->setBirthDate(new \DateTime('04/25/1975'));

        // replace this example code with whatever you need
        return $this->render(
                'default/index.html.twig',
                [
                    'superheroes' => $superheroes,
                ]
            );
    }

    /**
     * @Route("/detail/{superhero}", name="detail")
     */
    public function detailActon(Request $request, Superhero $superhero){

        return $this->render(
          'default/detail.html.twig',
            [
                'superhero' => $superhero,
            ]
        );
    }
}
