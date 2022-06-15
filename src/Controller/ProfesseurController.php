<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    public function __construct(EntityManagerInterface $om)
    {
        $this->om = $om;
    }

    #[Route('/professeur', name: 'app_professeur')]
    public function index(ProfesseurRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $prof = $repo->findAll();
        $profPaginator = $paginator->paginate(
            $prof,
            $request->query->getInt('page', 1),
            3
        );
        $i = 0;
        return $this->render(
            'professeur/index.html.twig',
            [
                'i' => $i,
                'controller_name' => 'ProfesseurController',
                'professeur' => $profPaginator
            ]
        );
    }

    #[Route('/professeur/add', name: 'app_professeur.add')]
    public function create(Request $request)
    {
        $professeur = new Professeur();
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $professeur = $form->getData();
            $professeur->setRp($this->getUser());
            $this->om->persist($professeur);
            $this->om->flush();
            $this->addFlash('success', 'Professeur ajouté avec succès');
            return $this->redirectToRoute('app_professeur');
        }
        return $this->render(
            'professeur/add.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
    #[Route('/professeur/{id}', name: 'app_professeur.edit', methods: 'GET|POST')]
    public function edit(Professeur $professeur, Request $request)
    {
        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $professeur->setRp($this->getUser());
            $this->om->flush();
            $this->addFlash('success', 'Professeur modifié avec succès');
            return $this->redirectToRoute('app_professeur');
        }
        return $this->render(
            'professeur/edit.html.twig',
            [
                'professeurs' => $professeur,
                'form' => $form->createView()
            ]
        );
    }
}
