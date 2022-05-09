<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Fisrt{


    //#[Route('{myVar}','what')]
   // public function what ($myVar){
        //return new Response("<h1>$myVar</h1>");
   // }


    /**
     * @Route ("/first")
     */
    public function first(){
        return new Response('<h1> Hello </h1>');
    }


    #[Route('/multi/{entier1}/{entier2<\d+>}', 
    name: 'multiplication',
    requirements:['entier1'=>'\d+',])] 

    public function multiplacation  ($entier1, $entier2){
        $resultat=$entier1*$entier2 ; 
        return new Response("<h1>$resultat</h1>");
    }

    


}

?>