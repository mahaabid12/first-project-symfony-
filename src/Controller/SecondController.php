<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SecondController extends AbstractController
{
    //entre crochet==> yifhim ili hia haja titbadil parametre fil route 
    #[Route('/second/{name}/{age}', name: 'app_second')]
    public function index($name,$age, Request $request, SessionInterface $session): Response

    {   if($session->has('number')){
        $session->set('number',1);
    }else {
        $session->set('number',$session->get('number')+1);
 
    }
        
        dump($request);
        return $this->render('second/index.html.twig', [
            'controller_name' => 'SecondController',
            'esm'=>$name,
            'age'=>$age,
        ]);
    }
}
