<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Fisrt{
    /**
     * @Route ("/first")
     */
    public function first(){
        return new Response('<h1> Hello </h1>');
    }

}

?>