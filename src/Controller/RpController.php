<?php

namespace App\Controller;

use App\Repository\RpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RpController extends AbstractController
{
    #[Route('/rp', name: 'app_rp')]
    public function index(RpRepository $repo): Response
    {
        $rp = $repo->findAll();
        return $this->render('rp/index.html.twig',
        [
            'controller_name' => 'RpController',
            'rp' => $rp
        ]);
    }
}
