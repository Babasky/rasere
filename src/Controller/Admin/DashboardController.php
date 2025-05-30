<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Entity\User;
use App\Entity\Forum;
use App\Entity\Membre;
use App\Entity\Accueil;
use App\Entity\Subgroup;
use App\Entity\Ressource;
use App\Entity\Responsite;
use App\Entity\Specialite;
use App\Entity\Coordinateur;
use App\Entity\SecretaireGeneral;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(AccueilCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Rasere');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Accueil', 'fa fa-home',Accueil::class);
        yield MenuItem::linkToCrud('Membres', 'fas fa-users', Membre::class);
        yield MenuItem::linkToCrud('SousGroupe', 'fas fa-users', Subgroup::class);
        yield MenuItem::linkToCrud('Secretaires', 'fas fa-users', SecretaireGeneral::class);
        yield MenuItem::linkToCrud('Coordinateurs', 'fas fa-users', Coordinateur::class);
        yield MenuItem::linkToCrud('Sites', 'fas fa-list', Site::class);
        yield MenuItem::linkToCrud('Responsables', 'fas fa-users', Responsite::class);
        yield MenuItem::linkToCrud('Ressources', 'fa fa-list', Ressource::class);
        yield MenuItem::linkToCrud('Spécialités', 'fa fa-list', Specialite::class);
        yield MenuItem::linkToCrud('Forum', 'fa fa-list', Forum::class);

    }
}
