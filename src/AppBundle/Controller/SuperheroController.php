<?php

namespace AppBundle\Controller;

use AppBundle\Form\SuperHeroForm;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
     * @Method({"GET","POST"})
     */
    public function createAction(Request $request){


        $superhero = new Superhero();
        $form = $this->createForm(SuperHeroForm::class,$superhero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($superhero);
            $entityManager->flush();

            return $this->redirectToRoute('detail',['id'=>$superhero->getId()]);
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
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request,$id){
        $repository=$this->getDoctrine()->getRepository(Superhero::class);
        $superhero=$repository->find($id);

        $form = $this->createForm(SuperHeroForm::class,$superhero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('detail',['id'=>$superhero->getId()]);
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
     * @Method({"GET","POST"})
     */
    public function deleteAction(Request $request,$id){
        $repository=$this->getDoctrine()->getRepository(Superhero::class);
        $superhero=$repository->find($id);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($superhero);
        $entityManager->flush();
        return $this->redirectToRoute('homepage');


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
