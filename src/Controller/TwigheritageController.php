<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigheritageController extends AbstractController
{
    #[Route('/twig', name: 'app_twigheritage')]
    public function index(): Response
    {
        return $this->render('twigheritage/index.html.twig');
    }
}
