<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 15/03/17
 * Time: 10.04
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    //la rotta deve avere lo stesso nome di quella nel file di config security.yml
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(){
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    //resta vuota, a noi serve solo per la rotta, il logout lo gestisce il framework
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(){

    }
}