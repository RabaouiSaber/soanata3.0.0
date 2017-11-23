<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\Application;



class CarController extends Controller {
    //put your code here
    
    public function indexAction($page=1)
    {
          

        
            if ($page < 1) {
              throw $this->createNotFoundException("La page ".$page." n'existe pas.");
            }

            // Ici je fixe le nombre d'annonces par page à 3
            // Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
            $nbPerPage = 3;

            // On récupère notre objet Paginator
            $listCars = $this->getDoctrine()
              ->getManager()
              ->getRepository('AppBundle:Car')
              ->getCars($page, $nbPerPage)
            ;

            // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
            $nbPages = ceil(count($listCars) / $nbPerPage);

            // Si la page n'existe pas, on retourne une 404
            if ($page > $nbPages) {
              throw $this->createNotFoundException("La page ".$page." n'existe pas.");
            }

            // On donne toutes les informations nécessaires à la vue
            return $this->render('AppBundle:Car:index.html.twig', array(
              'listAdverts' => $listCars,
              'nbPages'     => $nbPages,
              'page'        => $page,
            ));
  
        // Reponse sans view
         // *****************************************************
                // return new Response("Notre propore Hello World ");
         // *****************************************************
   
        // Reponse Avec view
         // *****************************************************
        /*
        $content = $this
                    ->get('templating')
                    ->render('OCPlatformBundle:Advert:index.html.twig', array('nom' => 'winzou'));
    
        return new Response($content);
        
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => array()
          ));
*/
        // *****************************************************
        
        /*
        // Générer URL 
        // *****************************************************
                $url = $this->get('router')->generate(
                   'oc_platform_view', // 1er argument : le nom de la route
                   array('id' => 5)    // 2e argument : les valeurs des paramètres
               );
               // $url vaut « /platform/advert/5 »

               return new Response("L'URL de l'annonce d'id 5 est : ".$url);
        
         // *****************************************************
         * 
         */
    }
    
    public function indexAjaxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->findAll();
        
        $contenu = $this->renderView('OCPlatformBundle:Advert:contenuAjax.html.twig', array(
                        'listAdverts' => $listAdverts
                      ));
        
        
        return new Response($contenu);
         
        
    }
    
    public function viewAction($id, Request $request)
    {
         // On récupère le repository
         /*
            // methode avec repository
            $repository = $this->getDoctrine()
              ->getManager()
              ->getRepository('OCPlatformBundle:Advert');
           
            // On récupère l'entité correspondante à l'id $id
            $advert = $repository->find($id);
          * 
          */
            
            
            // methode avec EM
            /*
            $advert = $this->getDoctrine()
                    ->getManager()
                    ->find('OCPlatformBundle:Advert', $id);
             * 
             */
        
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $car = $em->getRepository('AppBundle:Car')->find($id);


           

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

        return $this->render('AppBundle:Car:view.html.twig', array(
          'advert'           => $car,
         //  'listApplications' => $listApplications
        ));
        /*
         $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
          );

          return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert
          ));
         * 
         */
        //  return new Response("Affichage de l'annonce d'id : ".$id);
        
        
        /*
         // On récupère notre paramètre tag
            $tag = $request->query->get('tag');

            return new Response(
              "Affichage de l'annonce d'id : ".$id.", avec le tag : ".$tag
            );
            // ---> URL : /platform/advert/9?tag=developer
         *
         */
        
        /*
        // Manipuler l'objet Response
                   // On crée la réponse sans lui donner de contenu pour le moment
                    $response = new Response();

                    // On définit le contenu
                    $response->setContent("Ceci est une page d'erreur 404");

                    // On définit le code HTTP à « Not Found » (erreur 404)
                    $response->setStatusCode(Response::HTTP_NOT_FOUND);

                    // On retourne la réponse
                    return $response;
         * 
         */
        
        /*
          return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'id' => $id
          ));
         * 
         */
          
          
        /*
           $tag = $request->query->get('tag');

            return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
              'id'  => $id,
              'tag' => $tag,
            ));
         * 
         */
        
        /*
        // Redurection
         $url = $this->get('router')->generate('oc_platform_home');
    
         //return new RedirectResponse($url);
          return $this->redirect($url);
         * 
         *
         */
        
        /*
        // Session 
                // Récupération de la session
               $session = $request->getSession();

               // On récupère le contenu de la variable user_id
               $userId = $session->get('user_id');

               // On définit une nouvelle valeur pour cette variable user_id
               $session->set('user_id', 91);

               // On n'oublie pas de renvoyer une réponse
               return new Response("<body>Je suis une page de test, je n'ai rien à dire</body>");
         * 
         */
    }
    
 
  
  
     public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('AppBundle:Car:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listAdverts' => $listAdverts
    ));
  }
  
  
  
  
   public function editAction($id, Request $request)
  {
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {
          throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        
        /*
        // La méthode findAll retourne toutes les catégories de la base de données
        $listCategories = $em->getRepository('OCPlatformBundle:Category')->findAll();

        // On boucle sur les catégories pour les lier à l'annonce
        foreach ($listCategories as $category) {
          $advert->addCategory($category);
        }
         * 
         */
        $advert->setAuthor("RABAOUI Saber");

        // Pour persister le changement dans la relation, il faut persister l'entité propriétaire
        // Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine

        // Étape 2 : On déclenche l'enregistrement
        $em->flush();
    // ...
    /*
    $advert = array(
      'title'   => 'Recherche développpeur Symfony',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );
    * 
     */
    return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
      'advert' => $advert
    ));
     
  }
  
  
  
}

