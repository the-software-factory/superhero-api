<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 15/03/17
 * Time: 15:29
 */

namespace AppBundle\Controller;


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
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction(){
        $repository=$this->getDoctrine()->getRepository(Team::class);
        $teams=$repository->findAll();

        // replace this example code with whatever you need
        return $this->render('team/index.html.twig',
            [
                'teams'=>$teams,
            ]
        );
    }
    /**
     * @Route("/create", name="create_team")
     * @Method({"GET","POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createAction() {
        $team = new Team();
        $team->setName('Avengers');
        $team->setHq('Stark Tower');
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($team);
        $entityManager->flush();
        return $this->redirectToRoute('homepage_team');
    }

    /**
     * @Route("/delete/{id}", name="delete_team")
     * @Method({"GET","POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request,$id){
        $repository=$this->getDoctrine()->getRepository(Team::class);
        $team=$repository->find($id);

        if ($team==null){
            throw $this->createNotFoundException();
        }

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($team);
        $entityManager->flush();
        return $this->redirectToRoute('homepage_team');


    }

}