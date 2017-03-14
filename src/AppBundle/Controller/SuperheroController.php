<?php

namespace AppBundle\Controller;

use AppBundle\Form\SuperheroForm;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @Route("superhero")
 */
class SuperheroController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(SuperHero::class);

        $superheroes = $repository->findAll();

        // replace this example code with whatever you need
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
    public function detailAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(SuperHero::class);

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
     * @Method({"GET","POST"})
     * @param Request $request
     * @return Route
     */
    public function createAction(Request $request)
    {
        $superhero = new Superhero();

        $form = $this->createForm(SuperheroForm::class, $superhero);

        $form->handleRequest($request);
        // Verifico che abbia ricevuto un POST e non un GET
        if ($form->isSubmitted() && $form->isValid()) {
            // A questo punto sono sicuro che i dati sono stati spediti con un POST
            // e quindi posso salvarlo sul DB
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($superhero);
            $entityManager->flush();

            return $this->redirectToRoute('detail', [ 'id' => $superhero->getId() ]);
        }

        return $this->render(
            'default/create.html.twig',
            [
                'form'=> $form->createView(),
            ]
        );



    }

    /**
     * @Route("/all", name="allHeroes")
     */
    public function allHeroesAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(SuperHero::class);

        $superheroes = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render(
            'default/allHeroes.html.twig',
            [
                'superheroes' => $superheroes,
            ]
        );
    }
}
