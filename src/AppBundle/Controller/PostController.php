<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

/**
 * Description of Post
 *
 * @author alpha
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\Application;



class PostController extends Controller {
    //put your code here
    

    
   
    
    public function viewAction($id, Request $request)
    {
         
        
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $car = $em->getRepository('AppBundle:Post')->find($id);


            // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
            // ou null si l'id $id  n'existe pas, d'où ce if :
            if (null === $car) {
              throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
            }

            /*
              // On récupère la liste des candidatures de cette annonce
        $listApplications = $em
          ->getRepository('OCPlatformBundle:Application')
          ->findBy(array('advert' => $advert))
        ;
             * 
             */
           // $car->setTranslatableLocale('fr');
           // var_dump($car);
//            echo $car->getId();
//            echo "ggg ".$car->getTitle();
//            echo "ggg ".$car->getDraft();
           // die();
           
        return $this->render('AppBundle:Post:view.html.twig', array(
          'advert'           => $car,
         //  'listApplications' => $listApplications
        ));
        
    }
    
 
  
  
     public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listAdverts = array(
      array('id' => 1, 'title' => 'Recherche développeur Symfony'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );
    
    $page = 1;
    $nbPerPage = 3;

            // On récupère notre objet Paginator
            $listPost = $this->getDoctrine()
              ->getManager()
              ->getRepository('AppBundle:Post')
              ->getPost($page, $nbPerPage)
            ;

    return $this->render('AppBundle:Post:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listAdverts' => $listPost
    ));
  }
  

  
  
  
}

