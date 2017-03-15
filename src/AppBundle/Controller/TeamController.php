<?php
/**
 * Created by PhpStorm.
 * User: riccardo
 * Date: 15/03/17
 * Time: 15.16
 */

namespace AppBundle\Controller;

use AppBundle\Form\TeamForm;
use AppBundle\Model\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("team")
 */
class TeamController extends Controller
{


    /**
     * @Route("/", name="homepage_team")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Team::class);
        $teams = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('team/index.html.twig',            //cartella dove sta il template
            [
            'teams' => $teams,
        ]);
    }

    
    
    

    /**
     * @Route("/create", name="create_team")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createAction(Request $request)
    {
        $team = new Team();

        $form = $this->createForm(TeamForm::class, $team);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {              //controllo che il form sia spedito e sia valido
            $entityManager = $this->getDoctrine()->getManager();     //per salvare il mio supereroe nel db
            $entityManager->persist($team);
            $entityManager->flush();
            return $this->redirectToRoute('homepage_team', ['id' => $team->getId()]);        //se la post è valida, il browser mi porta qua
        }

        return $this->render(
            'team/create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }


        /**
         * @Route("/delete/{id}", name="delete_team")
         * @Method({"GET", "POST"})
         * @Security("has_role('ROLE_ADMIN')")
         */
        public function deleteAction($id){
            $repository = $this->getDoctrine()->getRepository(Team::class);
            $team = $repository->find($id);

            if($team===null){                                      //se non trova l'eroe
                throw  $this->createNotFoundException();                //fa questo
            }

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->remove($team);
            $entityManager->flush();

            return $this->redirectToRoute('homepage_team');
        }
    }
