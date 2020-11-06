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


    public function showMyName(){

        if (isset($_POST['name'])){
            var_dump($_POST['name']);
            $this->name = $this->session->get('name');
            return $this->render('learning/changeName.html.twig', ['name' => $this->name]);

        }
        else {
            return $this->render('learning/showName.html.twig', ['name' => 'unknown']);
        }

    }
/*
    public function showMyName(): response
    {
        return $this->render('learning/showName.html.twig', ['name' => 'unknown']);



    }
*/
    public function changeMyName()
    {
        $this->session->set('name', $_POST['name']);
        return $this->redirectToRoute('showname');
    }




}
