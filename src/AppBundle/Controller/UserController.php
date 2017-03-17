<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/api")
 */
class UserController extends Controller
{
    /**
     * @Route("/login", name="api_login")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function loginAction()
    {
        /** @var UserInterface $user */
        $user = $this->getUser();

        // NOTE: this is a hack, don't try this at home :)
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $firstName = 'Potente';
            $lastName = 'Amministratore';
        } else {
            $firstName = 'Normale';
            $lastName = 'Utente';
        }

        return $this->json(
            [
                'username' => $user->getUsername(),
                'roles' => $user->getRoles(),
                'firstName' => $firstName,
                'lastName' => $lastName,
            ]
        );
    }
}
