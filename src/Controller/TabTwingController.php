<?php

namespace App\Controller;

use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class TabTwingController extends AbstractController
{
    #[Route('/tab/{num</d+>}', name: 'app_tab_twing')]
    public function index($num): Response

    {
        $tab=[];
        $s=0;
        for( $i=0 ; $i<$num ; $i++){
            $tab[$i]=1 ;
            $s+=$tab[$i];
        }
        return $this->render('tab_twing/index.html.twig',[
            'tab'=>$tab, 
            'somme'=>$s
        ]
   
        );
    }


    #[Route('/tab/users ', name: 'tabUser')]

    public function users(): Response
    {
        $users=[['firstname'=>'maha','name'=>'9ahba' ,'age'=>21],
                ['firstname'=>'aida','name'=>'9ahba' ,'age'=>21],
                ['firstname'=>'aicha','name'=>'9ahba' ,'age'=>21]];
        
        return $this->render('tab_twing/tab.html.twig',[
            'users'=>$users 
        ]);

    }
}
