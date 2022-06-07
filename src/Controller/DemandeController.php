<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\DemandeRepository;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function index(DemandeRepository $repo, PaginatorInterface $paginator,
    Request $request): Response
    {
        $demandes = $repo->findAll();
        $pagination_demande = $paginator->paginate(
            $demandes,
            $request->query->getInt('page', 1 ),
            5
        );
        return $this->render('demande/index.html.twig',
        [
            'controller_name' => 'DemandeController',
            'demandes' => $pagination_demande
        ]);
    }
}
