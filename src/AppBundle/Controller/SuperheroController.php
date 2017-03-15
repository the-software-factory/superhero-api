<?php

namespace AppBundle\Controller;         //DEVE COMBACIARE CON QUELLO SOTTO src

use AppBundle\Model\Superevil;
use AppBundle\Model\Superhero;
use AppBundle\Form\SuperheroForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
    public function detailAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);
        if($superhero===null){                                      //se non trova l'eroe
            throw  $this->createNotFoundException();                //fa questo
        }

        return $this->render(
            'default/detail.html.twig',         //non abbiamo il template, lo andiamo a creare all'interno di default
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
        if ($form->isSubmitted() && $form->isValid()) {              //controllo che il form sia spedito e sia valido
            $entityManager = $this->getDoctrine()->getManager();     //per salvare il mio supereroe nel db
            $entityManager->persist($superhero);
            $entityManager->flush();
            return $this->redirectToRoute('detail', ['id' => $superhero->getId()]);        //se la post è valida, il browser mi porta qua
        }

        return $this->render(
            'default/create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }




    /*rotta

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

    }               CREAZIONE A MANO DEI SUPEREROI
*/


    /**
     * @Route("/edit/{id}", name="edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);

        if($superhero===null){                                      //se non trova l'eroe
            throw  $this->createNotFoundException();                //fa questo
        }

        $form = $this->createForm(SuperheroForm::class, $superhero);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();     //per salvare il mio supereroe nel db
           // $entityManager->persist($superhero);      NON SERVE
            $entityManager->flush();
            return $this->redirectToRoute('detail', ['id' => $superhero->getId()]);
        }

        return $this->render(
            'default/edit.html.twig',         //non abbiamo il template, lo andiamo a creare all'interno di default
            [
                'form' => $form->createView(),
            ]
        );
    }



    /**
     * @Route("/delete/{id}", name="delete")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id){
        $repository = $this->getDoctrine()->getRepository(Superhero::class);
        $superhero = $repository->find($id);

        if($superhero===null){                                      //se non trova l'eroe
            throw  $this->createNotFoundException();                //fa questo
        }

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($superhero);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
    
}
