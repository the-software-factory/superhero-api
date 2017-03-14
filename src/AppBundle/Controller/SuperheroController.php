<?php

namespace AppBundle\Controller;

use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $repository=$this->getDoctrine()->getRepository(Superhero::class);
        $superheros=$repository->findAll();
        $how=count($superheros);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig',
            [
                'superheros'=>$superheros,
                'how'=>$how
            ]
            );
    }

    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function detailAction ($id){
        $repository=$this->getDoctrine()->getRepository(Superhero::class);
        $superhero=$repository->find($id);


        return $this->render('default/detail.html.twig',
            [
                'superhero' => $superhero
            ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function createAction(Request $request){


        $superhero = new Superhero();
        $superhero->setName('Superman');
        $superhero->setRealName('Clark Kent');
        $superhero->setLocation('Metropolis');
        $superhero->setHasCloak(false);
        $superhero->setBirthDate(new \DateTime('04/25/1979'));

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($superhero);
        $entityManager->flush();

        return $this->redirectToRoute('detail',['id'=>$superhero->getId()]);

    }

    /**
     * @Route("/allHero", name="allHero")
     */
    public function allHeroAction(Request $request)
    {
        $repository=$this->getDoctrine()->getRepository(Superhero::class);
        $superheros=$repository->findAll();
        // replace this example code with whatever you need
        return $this->render('default/allHero.html.twig',
            [
                'superheros'=>$superheros
            ]);
    }
}
