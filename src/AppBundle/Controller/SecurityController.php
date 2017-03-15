<?php
/**
 * Created by PhpStorm.
 * User: riccardo
 * Date: 15/03/17
 * Time: 10.05
 */

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



//DA QUA HO SCRITTO TUTTO IO 



class SecurityController extends Controller
{
    
    /**
     * @Route("/login", name="login")
    */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }




    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
            //MAI ESEGUITA SERVE SOLO PER CARICARE LA ROTTA
    }
    
}