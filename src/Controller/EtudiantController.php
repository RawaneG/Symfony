<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    public function __construct( EntityManagerInterface $om)
    {
        $this->om = $om;
    }
                    /***************** CRUD : READ **********************/

    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(EtudiantRepository $repo, PaginatorInterface $paginator,
    Request $request): Response
    {
        $etudiants = $repo->findAll();
        $etudiant_pagination = $paginator->paginate(
            $etudiants,
            $request->query->getInt('page',1),
            5
        );
        $i = 0;
        return $this->render('etudiant/index.html.twig',
        [
            'i' => $i,
            'controller_name' => 'EtudiantController',
            'etudiants' => $etudiant_pagination
        ]);
    }
                    /*************** CRUD : CREATE *********************/

    #[Route('/etudiant/add', name: 'app_etudiant.add')]
    public function create(Request $request)
    {
        $etudiant = new Etudiant ();
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->om->persist($etudiant);
            $this->om->flush();
            return $this->redirectToRoute('app_etudiant');
        }
        return $this->render('etudiant/add.html.twig',
        [
            'etudiants' => $etudiant,
            'form' => $form->createView()
        ]);
    }
                    /****************** CRUD : EDIT **********************/

    #[Route('/etudiant/{id}', name: 'app_etudiant.edit')]
    public function edit(Etudiant $etudiant, Request $request)
    {
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->om->flush();
            return $this->redirectToRoute('app_etudiant');
        }
        return $this->render('etudiant/edit.html.twig',
        [
            'etudiants' => $etudiant,
            'form' => $form->createView()
        ]);
    }
}
