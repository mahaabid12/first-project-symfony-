<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


//prefixe 
#[Route('/todo')]
class ToDoController extends AbstractController
{
    #[Route('/', name: 'todo')]
    public function index(SessionInterface $session): Response
    { 
        if(!$session->has('tasks') ){
            $array=array(
                'achat'=>'acheter clé usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
                );
            $session->set('tasks', $array);
            $this->addFlash('info', "le liste des tods vient d'etre initialise");
            
        }
        return $this->render('to_do/index.html.twig', [
            'controller_name' => 'ToDoController',
            
        ]);
    }


    
    #[Route('/add/{name?test}/{content?test}', 
    name: 'addtodod')]
    //defaults: ['content'=>'sf6','name'=>'techwall'])]
    public function addTodo (SessionInterface $session,$name,$content) : RedirectResponse
    {
        if ($session->has('tasks')){
            $tasks=$session->get('tasks');
            if ( !isset ($tasks[$name])){
               $tasks[$name]=$content;
               $session->set('tasks',$tasks);
               //add  flashbahs  action to the abstract controller 
               $this->addFlash('success', "la todod est ajouté ");
            }else {
                $this->addFlash('error', "le  todo existe deja ");
                
            }
        }else{
        $this->addFlash('error', "le liste des todos n'est pas encore initialisé ");
        }

        return $this->redirectToRoute('todo');
    
}
    #[Route('/update/{name}/{content}', name: 'updatetodod')] 
    
    public function updateToDo(SessionInterface $session , $name , $content){
        if($session->has('tasks')){
            $tasks=$session->get('tasks'); 
            if(array_key_exists($name, $tasks)){
                $tasks[$name]=$content;
                $session->set('tasks',$tasks);
                $this->addFlash('success ', 'task updated');

            }else{
                $this->addFlash('error', 'task not found');
            }

        }else{
            $this->addFlash('error', 'you need to initialize tasks ');

        }

        return $this->redirectToRoute('todo');

    }
    



    #[Route('/delete/{name}', name: 'deletetodod')] 
        public function deleteToDo(SessionInterface $session , $name ) : RedirectResponse
    {
        if($session->has('tasks')){
            $tasks=$session->get('tasks'); 
            if(array_key_exists($name, $tasks)){
                unset($tasks[$name]);
                $session->set('tasks',$tasks);
                $this->addFlash('success ', 'task deleted');

            }else{
                $this->addFlash('error', 'task not found');
            }

        }else{
            $this->addFlash('error', 'you need to initialize tasks ');

        }

        return $this->redirectToRoute('todo');

    }


    #[Route('/reset', name: 'reset')] 
    public function resetTodo(SessionInterface $session) : RedirectResponse
    {
        $session->remove('tasks');
        return $this->redirectToRoute('todo');

    }

    


    
    

}
    
