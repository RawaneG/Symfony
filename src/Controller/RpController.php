<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\RpRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RpController extends AbstractController
{
    #[Route('/rp', name: 'app_rp')]
    public function index(RpRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $rp = $repo->findAll();
        $rpPaginator = $paginator->paginate(
            $rp,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('rp/index.html.twig',
        [
            'controller_name' => 'RpController',
            'rp' => $rpPaginator
        ]);
    }
}
