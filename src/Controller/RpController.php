<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\RpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RpController extends AbstractController
{
    #[Route('/rp', name: 'app_rp')]
    public function index(RpRepository $repo, PaginatorInterface $teningPaginator, Request $request): Response
    {
        $rp = $repo->findAll();
        $rpPaginator = $teningPaginator->paginate(
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
