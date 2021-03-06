<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\AcRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcController extends AbstractController
{
    #[Route('/ac', name: 'app_ac')]
    public function index(): Response
    {
        return $this->render('ac/index.html.twig', [
            'controller_name' => 'AcController',
        ]);
    }
}
