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
        $repository = $this->getDoctrine()->getRepository(Superhero::class);

        $superheroes = $repository->findAll();

        return $this->render(
                'default/index.html.twig',
                [
                    'superheroes' => $superheroes,
                ]
            );
    }

    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function detailActon(Request $request, $id){

        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);

        return $this->render(
          'default/detail.html.twig',
            [
                'superhero' => $superhero,
            ]
        );
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request){

        $superhero = new Superhero();

        $superhero->setName('Superman');
        $superhero->setRealName('Clark Kent');
        $superhero->setLocation('Metropolis');
        $superhero->setHasCloak(false);
        $superhero->setBirthDate(new \DateTime('04/25/1975'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($superhero);
        $entityManager->flush();

        return $this->redirectToRoute('detail', ['id' => $superhero->getId()]);
    }

    /**
     * @Route("/allHero", name="allHero")
     */
    public function allHero(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);

        $superheroes = $repository->findAll();

        return $this->render(
            'default/allHero.html.twig',
            [
                'superheroes' => $superheroes,
            ]
        );
    }
}
