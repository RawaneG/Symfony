<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\ProfesseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(ProfesseurRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $prof = $repo->findAll();
        $profPaginator = $paginator->paginate(
            $prof,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('professeur/index.html.twig',
        [
            'controller_name' => 'ProfesseurController',
            'professeur' => $profPaginator
        ]);
    }
}
