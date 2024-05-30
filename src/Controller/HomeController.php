<?php

namespace App\Controller;
use App\Entity\Alerte;
use App\Entity\BoiteFibre;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Admin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Repository\AdminRepository;
class HomeController extends AbstractController
{    private $passwordHasher;

    public function __construct( private Security $security,UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
       
    }
    
    /////////////connexion//////////////////////////
#[Route('/', name: 'app_login', methods:['GET','POST'])]
public function connexion(AdminRepository $repository,AuthenticationUtils $authenticationUtils): Response
    {    if($this->getUser())
        {
            return $this->redirectToRoute('Accueil');

        }
        
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        if($error){
            $this->addFlash(
                'echec',
                'identifiant ou/et mot de passe incorrect'
            );
               
        }
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        
        
        
       
        // $user = $this->security->getUser();
        
        // dd($user);
        return $this->render('home/login.html.twig', [
            'controller_name' => 'HomeController',
            'last_username' => $lastUsername,
             'error'         => $error,
            //  'user'=>$user,
            
        ]);
    }
// ////////////////////////////////////////////////////
////////////////creer compte////////////////////////////////////

#[Route('/nouveauCompte', name: 'nouveau_compte')]
public function nouveaucompte(Request $request,EntityManagerInterface $manager): Response
{ $username= $this->getUser();
    $user=new Admin();
   // $user->setRoles();
    $form=$this->createForm(UserType::class , $user);
    $form->handleRequest($request);
    // dd($form);
    if ( $form->isSubmitted() && $form->isValid() )
    {  //pour coder le mot de passe
      $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));

          $user=$form->getData();
          $manager->persist($user);
          $manager->flush();
    $this->addFlash(
        'success',
        'votre compte a été créé avec succès. Merci de vous connecter.'
    );
    return $this->redirectToRoute('app_login');
    }
    return $this->render('home/nouveau_compte.html.twig', [
        'controller_name' => 'HomeController',
        'form'=>$form->createView(),
        'username'=>$username
    ]);
}


//////////////////////////////////////////////////////////
///////////////////Accueil/////////////////////////////
    #[Route('/Accueil', name: 'Accueil')]
    public function index(EntityManagerInterface $em): Response
    { $fibreBoxes = $em->getRepository(BoiteFibre::class)->findAll();
        //  dd($fibreBoxes);
        $fibreBoxData = [];
        foreach ($fibreBoxes as $box) {
            $fibreBoxData[] = [
                'id' => $box->getId(),
                'latitude' => $box->getLatitude(),
                'longitude' => $box->getLongitude(),
                'status' => $box->getStatus(),
                'nom'=>$box->getNom()
            ];}
        return $this->render('home/Accueil.html.twig', [
            'controller_name' => 'HomeController',
            'fibreBoxes' => $fibreBoxes,
            
        ]);
    }

    /////////////////////////////////////////////////////   
 ////////////////// logout /////////////////
 #[Route('/logout', name: 'applogout', methods: ['GET'])]
 public function logout():never
 {
     // controller can be blank: it will never be called!
     
     throw new \Exception('Don\'t forget to activate logout in security.yaml');
     
 }
///////////////////////////////////
#[Route('/map', name: 'map')]
public function map(EntityManagerInterface $em): Response
{  $fibreBoxes = $em->getRepository(BoiteFibre::class)->findAll();
    //  dd($fibreBoxes);
    $fibreBoxData = [];
    foreach ($fibreBoxes as $box) {
        $fibreBoxData[] = [
            'id' => $box->getId(),
            'latitude' => $box->getLatitude(),
            'longitude' => $box->getLongitude(),
            'status' => $box->getStatus(),
            'nom'=>$box->getNom()
        ];
    }
   
    // Récupérer les boîtes de fibre optique de la base de données
    $fibreBoxes = $em->getRepository(BoiteFibre::class)->findAll();
     
    return $this->render('home/map.html.twig', [
        'fibreBoxes' => $fibreBoxes,
        
    ]);
}

#[Route('/Accueil/historique', name: 'historique')]
public function historique(EntityManagerInterface $em): Response
{
  
     
    return $this->render('home/historique.html.twig', [
        
    ]);
}

#[Route('/Accueil/alerte', name: 'alerte')]
public function alerte(EntityManagerInterface $em): Response
{
    $alertes = $em->getRepository(Alerte::class)->findAll();
     
    return $this->render('home/Alert.html.twig', [
        'alertes'=>$alertes
        
    ]);
}
#[Route('/fibre', name: 'fibre')]
    public function boitefibre(EntityManagerInterface $em): Response
    { $fibres = $em->getRepository(BoiteFibre::class)->findAll();
    
        return $this->render('home/boitefibre.html.twig', [
          'fibres'=> $fibres 
            
        ]);
    }
}

