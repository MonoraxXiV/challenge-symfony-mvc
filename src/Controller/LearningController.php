<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LearningController extends AbstractController
{
    private $session;
    private string $name;


    //Documentation:https://symfony.com/doc/current/session.html
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }


    public function index(): Response
    {
        return $this->render('learning/index.html.twig', [
            'controller_name' => 'LearningController',
        ]);
    }

    /**
     * @Route("/about-becode", name="about")
     */

    public function aboutMe(): Response
    {
        $sessionName = $this->session->get('sessionName', 'unknown');
        if ($sessionName=='unknown'){
            return $this->forward('App\Controller\LearningController::showMyName');
        }else {
            return $this->render('learning/aboutme.html.twig', ['name' => $sessionName]);
        }
    }


    /**
     * @Route("/changemyname", name="changeName")
     */
    public function changeMyName()
    {

        $sessionName = $this->session->get('sessionName', 'unknown');
        return $this->render('learning/changeName.html.twig', ['name' => $sessionName]);


    }

    /**
     * @Route("/", name="home")
     */

    public function showMyName()
    {


        if (isset($_POST['name'])) {
            $this->session->set('sessionName', $_POST['name']);
            return $this->redirectToRoute('changeName');
        }
        $sessionName = $this->session->get('sessionName', 'unknown');
        if (isset($sessionName)) {
            var_dump($sessionName);
            return $this->render('learning/showName.html.twig', ['name' => $sessionName]);

        }
    }


}
