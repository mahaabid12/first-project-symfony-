<?php

namespace App\Controller;


use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController


{

    //paramconverter : id si l'id n'exsice pas il va retourner une erreur  
    #[Route('/personne/remove/{id<\d+>}', name: 'removePersoone')]
    public function remove(Personne $person = null , ManagerRegistry $doctrine) : RedirectResponse
    {
        if ($person ==null){
            $this->addFlash('error','Person not found'); 
            return ($this->redirectToRoute('personne'));

        }else {
            $manager=$doctrine->getManager(); 
            //ajout la fonction de suppression dans la transaction 
            $manager->remove($person);
            //excecuter la transaction 
            $manager->flush();
            $s=$person->getFirstname();
            $this->addFlash('success', " $s successfully removed "); 
            return ($this->redirectToRoute('personne'));

        }
        
    }


    #[Route('/personne/{page<\d+>?1}/{nbre?12}', name: 'personne')]
    public function index (ManagerRegistry $doctrine,$page, $nbre): Response
    {
        $repisotory=$doctrine->getRepository(Personne::class);
        $nbreT=count($repisotory->findAll()); 
        $nbrePage=ceil($nbreT/$nbre);

        //page 1 ==>0->9 
        //page 2 ==>10->19  
        $persons=$repisotory->findBy([],['name'=>'ASC'],$nbre,($page-1)*$nbre ); 
        return $this->render('personne/personne.html.twig',[
            'persons'=>$persons,
            'nbrePage'=>$nbrePage, 
            'page'=>$page,
            'nbre'=>$nbre
        ]);
    

    }

    #[Route('/personne/{id<\d+>}', name: 'detailPersonne')]
    //paramConverter
    public function detail (ManagerRegistry $doctrine , $id): Response
    {
        $repisotory=$doctrine->getRepository(Personne::class); 
        $person=$repisotory->find($id); 
        if(!$person ){
            $this->addFlash('error',"Person not found "); 
            return $this->redirectToRoute('personne'); 

        }
        return $this->render('personne/detail.html.twig',[
            'person'=>$person 
        ]);
    }


    #[Route('/personne/add ', name: 'addPersoone')]
    public function addPersonne (ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager(); 
        $personne= new Personne();
        $personne->setFirstname('maha') ; 
        $personne->setName('abid'); 
        $personne->setAge(20); 
        $personne->setMood("kizebi");

        $personne2= new Personne();
        $personne2->setFirstname('rym') ; 
        $personne2->setName('mtibaa'); 
        $personne2->setAge(20); 
        $personne2->setMood("happy");

        $personne3= new Personne();
        $personne3->setFirstname('rym') ; 
        $personne3->setName('mtibaa'); 
        $personne3->setAge(20); 
        $personne3->setMood("happy");
        
        
        //le préparer pour l'excécution
        //si ce objet existe il va comprendre qy'il s'agit bd'une modification 
        $entityManager->persist($personne); 
        $entityManager->persist($personne2); 
        $entityManager->persist($personne3); 

        //excecution
        $entityManager->flush(); 


        return $this->render('personne/index.html.twig', [
            'personne' => $personne,
        ]);
    }



    #[Route('/personne/update/{id}/{firstname}/{name}/{mood}', name: 'updataPersoone')]
    public function upfatePersonne (Personne $person=null , $firstname, $name , $mood , ManagerRegistry $doctrine): RedirectResponse
    {
        if($person == null ){
            $this->addFlash('error',"PersonNotFound");
        }else{

            $manager=$doctrine->getManager();
            $person->setFirstname($firstname); 
            $person->setName($name); 
            $person->setMood($mood);
            $manager->persist($person); 
            $manager->flush();
            $this->addFlash('success', "updated person");


        };
        return $this->redirectToRoute('personne'); 
    }



    
}
