<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Form\SuperheroForm;
use AppBundle\Model\Superhero;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/api/superheroes")
 */
class SuperheroController extends Controller
{
    /**
     * @Route("", name="api_superheroes_list")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);

        $superheroes = $repository->findAll();

        // NOTE: missing pagination
        return $this->json($superheroes);
    }

    /**
     * @Route("/{id}", name="api_superheroes_view")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function viewAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);

        $superhero = $repository->find($id);
        if ($superhero === null) {
            throw $this->createNotFoundException();
        }

        return $this->json($superhero);
    }

    /**
     * @Route("", name="api_superheroes_create")
     * @Method("POST")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createAction(Request $request)
    {
        $superhero = new Superhero();

        $form = $this->createForm(SuperheroForm::class, $superhero);

        $this->decodeJsonRequestBody($request);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new BadRequestHttpException('Invalid request.');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($superhero);
        $entityManager->flush();

        return $this->json($superhero, 201);
    }

    /**
     * @Route("/{id}", name="api_superheroes_edit")
     * @Method("PATCH")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);

        $superhero = $repository->find($id);
        if ($superhero === null) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(SuperheroForm::class, $superhero, [ 'method' => 'PATCH' ]);

        $this->decodeJsonRequestBody($request);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return new BadRequestHttpException('Invalid request.');
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->json($superhero, 200);
    }

    /**
     * @Route("/{id}", name="api_superheroes_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Superhero::class);

        $superhero = $repository->find($id);
        if ($superhero === null) {
            throw $this->createNotFoundException();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($superhero);
        $entityManager->flush();

        return $this->json(null, 204);
    }

    /**
     * Replaces the request body with the json-decoded version.
     */
    private function decodeJsonRequestBody(Request $request): Request
    {
        // Do not try to json_decode when no body, or for non json requests.
        if (empty($request->getContent())) {
            return $request;
        }

        $decodedData = json_decode($request->getContent(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new BadRequestHttpException('Provided request is not a valid JSON.');
        }

        $request->request->replace($decodedData);

        return $request;
    }
}
