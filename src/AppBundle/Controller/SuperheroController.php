<?php

namespace AppBundle\Controller;

use AppBundle\Form\SuperheroForm;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Security("has_role('ROLE_USER')")
     */
    public function detailAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(SuperHero::class);

        $superhero = $repository->find($id);

        if ($superhero == null) {
            // Io lancio un eccezione, il framework la gestisce in automatico
            // creando una pagina 404
            throw $this->createNotFoundException();
        }

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
     * @Security("has_role('ROLE_ADMIN')")
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
     * @Route("/edit/{id}", name="edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, $id) {
        $repository = $this->getDoctrine()->getRepository(SuperHero::class);
        $superhero = $repository->find($id);

        if ($superhero == null) {
            // Io lancio un eccezione, il framework la gestisce in automatico
            // creando una pagina 404
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(SuperheroForm::class, $superhero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('detail', [ 'id' => $superhero->getId() ]);
        }

        return $this->render(
            'default/edit.html.twig',
            [
                'form'=> $form->createView(),
            ]
        );
    }

    /**
     * @Route("/all", name="allHeroes")
     * @Method({"GET", "POST"})
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

    /**
     * @Route("/delete/{id}", name="delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(SuperHero::class);
        $superhero = $repository->find($id);

        if ($superhero == null) {
            // Io lancio un eccezione, il framework la gestisce in automatico
            // creando una pagina 404
            throw $this->createNotFoundException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($superhero);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
