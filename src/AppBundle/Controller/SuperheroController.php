<?php

namespace AppBundle\Controller;

use AppBundle\Form\SuperheroForm;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("superhero")
 */
class SuperheroController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Security("has_role('ROLE_USER')")
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
     * @Security("has_role('ROLE_USER')")
     */
    public function detailAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);

        $superhero = $repository->find($id);
        if (!$superhero === null) {
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
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createAction(Request $request)
    {
        $superhero = new Superhero();
        $form = $this->createForm(SuperheroForm::class, $superhero);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($superhero);
            $entityManager->flush();
            return $this->redirectToRoute('detail', ['id' => $superhero->getId()]);
        }

        return $this->render(
            'default/create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);
        $form = $this->createForm(SuperheroForm::class, $superhero);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('detail', ['id' => $superhero->getId()]);
        }
        if (!$superhero === null) {
            throw $this->createNotFoundException();
        }
        return $this->render(
            'default/edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);
        if (!$superhero === null) {
            throw $this->createNotFoundException();
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($superhero);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/allHero", name="allHero")
     */
    public function allHeroAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superheroes = $repository->findAll();
        // replace this example code with whatever you need
        return $this->render('default/allHero.html.twig',
            [
                'superheroes' => $superheroes
            ]);
    }
}
