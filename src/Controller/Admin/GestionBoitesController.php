<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Alerte;
use App\Entity\BoiteFibre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;


class GestionBoitesController extends AbstractDashboardController
{ 
    public function __construct(private ChartBuilderInterface $chartBuilder) {
}
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(BoiteFibre::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        return $this->render('home/dashboard.html.twig',[
            'chart' => $chart,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion des boites');
    }

    public function configureMenuItems(): iterable
    {   yield MenuItem::linkToRoute('Accueil','fa fa-home','Accueil');
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('BoiteFibre', 'fas fa-list', BoiteFibre::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', Admin::class);
        
        yield MenuItem::linkToCrud('Alerte', 'fa fa-bell', Alerte::class);
        yield MenuItem::linkToUrl('Video', 'fa fa-video-camera','https://drive.google.com/drive/folders/1wGUWKRWSOuK77OCh99M2KPRcE30iW6ps?fbclid=IwZXh0bgNhZW0CMTAAAR35NK_BO6g7y3aJrP7LXMuDwspid5eS7Nq0MPHAvemwYD89mA50cUU4Q-Y_aem_AQhyXJWhAdIWbjOwy2q3WhdtGF36nMPiJlKrHKf55gAJUBcMKo8gDMWLyIpjnwoqV_bwSmh1Sx68WCVK07FSz8w-');
    }
}
