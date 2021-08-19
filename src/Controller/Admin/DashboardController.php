<?php

namespace App\Controller\Admin;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\HistoricQuestion;
use App\Repository\QuestionRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use Exporter\Handler;
use Exporter\Source\PDOStatementSourceIterator;
use Exporter\Writer\CsvWriter;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();
    
            $routeBuilder = $this->get(AdminUrlGenerator::class);

            return $this->redirect($routeBuilder->setController(QuestionCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FrgConsulting');
    }

    public function configureMenuItems(): iterable
    {   yield MenuItem::linktoRoute('Home', 'fas fa-home', 'home');
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-database');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
     
        yield MenuItem::linktoRoute('Export data', 'fas fa-download', 'export');
        yield MenuItem::linkToCrud('Questions', 'fas fa-map-marker-alt', Question::class);
        yield MenuItem::linkToCrud('Answers', 'fas fa-comments', Answer::class);
        yield MenuItem::linkToCrud('HistoricQuestions', 'fas fa-comments', HistoricQuestion::class);
    }


}

