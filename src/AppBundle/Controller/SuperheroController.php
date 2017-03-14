<?php

//il namespace deve combaciare con la struttura delle cartelle
namespace AppBundle\Controller;

use AppBundle\Form\SuperheroForm;
use AppBundle\Model\HeroList;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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

    //Method dice quali metodi deve supportare la funzione
    /**
     * @Route("/create", name="create")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request){

        $superhero = new Superhero();

        $form = $this->createForm(SuperheroForm::class, $superhero);

        //gestisce la richiesta di POST che di solito nei GET e vuota perche richiede una pagina non modifica i dati
        $form->handleRequest($request);

        // vale true solo quando la richiesta sopra e una POST e serve a evitare che uno crei qualcosa facendo un refresh ad esempio
        if($form->isSubmitted() && $form->isValid()){
            //ora superhro contiene tutti i dati passati nel form tramite hendleRequest
            //assumo che il form sia valido
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($superhero);
            $entityManager->flush();

            return $this->redirectToRoute('detail', ['id' => $superhero->getId()]);
        }
        //una volta finito di inserire nel form l'utente di solito va rediretto verso un'altra destinazione cosi ha capito che ha funzionato

        //ora va gestita la visualizzazione del form
        //lo visualizza quando mando il GET la prima volta
        return $this->render(
            'default/create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Request $request
     * @Route("/edit/{id}", name="edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id){
        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);

        $form = $this->createForm(SuperheroForm::class, $superhero);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($superhero);
            $entityManager->flush();
            return $this->redirectToRoute('detail', ['id' => $superhero->getId()]);
        }

        return $this->render(
            'default/edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("delete/{id}", name="delete")
     */
    public function deleteAction($id){
        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($superhero);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
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
