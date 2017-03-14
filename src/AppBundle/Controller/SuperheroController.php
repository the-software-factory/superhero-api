<?php

namespace AppBundle\Controller;         //DEVE COMBACIARE CON QUELLO SOTTO src

use AppBundle\Model\Superevil;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("superhero")
 */
class SuperheroController extends Controller            //HO CAMBIATO IL NOME
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superheroes = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'superheroes' => $superheroes,
        ]);
    }


    /**
     * @Route("/allHero", name="allHero")
     */
    public function allHeroAction(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superheroes = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('default/allHero.html.twig', [
            'superheroes' => $superheroes,
        ]);
    }


    /**
     * @Route("/detail/{id}", name="detail")
     */

    public function detailAction(Request $request, $id){

        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);

        return $this->render(
            'default/detail.html.twig',         //non abbiamo il template, lo andiamo a creare all'interno di default
            [
                'superhero'=>$superhero,
            ]
        );
    }


    /**
     * @Route("/create", name="create")
     */
    public function createAction(Request $request){
        $superhero= new Superhero();
        $superhero->setName('Batman');       //INCAPSULAMENTO , RICHIAMO FUNZIONE PER SCRIVERE VARIABILE PRIVATA
        $superhero->setRealName('Clark Kent');
        $superhero->setLocation('Metropolis');
        $superhero->setHasCloak(true);
        $superhero->setBirthDate(new \DateTime('04/25/1975'));

        $entityManager=$this->getDoctrine()->getManager();     //per salvare il mio supereroe nel db
        $entityManager->persist($superhero);
        $entityManager->flush();

        return $this->redirectToRoute('detail', ['id' => $superhero->getId() ]);

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
