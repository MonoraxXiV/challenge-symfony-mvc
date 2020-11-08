<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LearningController extends AbstractController
{
    private  $session;
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



    public function aboutMe(): Response
    {
       return $this->render('learning/aboutme.html.twig', ['name' => 'BeCode']);
    }

    /**
     * @Route("/", name="showname")
     */


    public function changeMyName(){

        if (isset($_GET['name'])){
            var_dump($_GET['name']);
            $name=$_GET['name'];
            return $this->render('learning/changeName.html.twig', ['name' => $_GET['name']]);

        }
        else {
            return $this->render('learning/showName.html.twig', ['name' => 'unknown']);
        }

    }



    public function showMyName()
    {
        $this->session->set('name', $_GET['name']);
        return $this->redirectToRoute('showname');
    }




}
