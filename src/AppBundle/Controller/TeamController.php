<?php
/**
 * Created by PhpStorm.
 * User: lorenzo
 * Date: 15/03/17
 * Time: 15.29
 */

namespace AppBundle\Controller;


use AppBundle\Model\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;

/**
 * Class TeamController
 * @package AppBundle\Controller
 * @Route("team")
 */
class TeamController extends Controller
{
    /**
     * @Route("/", name="homepage_team")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Team::class);

        $teams = $repository->findAll();
        return $this->render(
            'team/index.html.twig',
            [
                'teams' => $teams,
            ]
        );
    }
    /**
     * @Route("/create", name="create_team")
     * @Security("has_role('ROLE_USER')")
     */
    public function createTeam()
    {
        $team = new Team();
        $team->setName('Avengers');
        $team->setHq('Stark Tower');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($team);
        $entityManager->flush();

        return $this->redirectToRoute('homepage_team', []);
    }

    /**
     * @Route("/delete/{id}", name="delete_team")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Team::class);
        $team = $repository->find($id);

        if ($team == null) {
            // Io lancio un eccezione, il framework la gestisce in automatico
            // creando una pagina 404
            throw $this->createNotFoundException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($team);
        $entityManager->flush();

        return $this->redirectToRoute('homepage_team');
    }
}