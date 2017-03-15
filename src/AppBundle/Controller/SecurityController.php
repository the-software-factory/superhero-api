<?php
/**
 * Created by PhpStorm.
 * User: bledi
 * Date: 15/03/2017
 * Time: 10:04
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function  loginAction(){

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig',
            [
            'last_username' => $lastUsername,
            'error'         => $error,
            ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(){
        //Non è mai eseguita, serve solo a creare un percorso per il logout
    }

}