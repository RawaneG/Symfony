<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    public function __construct(EntityManagerInterface $om)
    {
        $this->om = $om;
    }

    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $resp, PaginatorInterface $paginator, Request $request): Response
    {
        $classe = $resp->findAll();
        $classePaginator = $paginator->paginate(
            $classe,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render(
            'classe/index.html.twig',
            [
                'controller_name' => 'ClasseController',
                'classes' => $classePaginator
            ]
        );
    }
    #[Route('/classe/add', name: 'app_classe.add')]
    public function create(Request $request)
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $classe->setRp($this->getUser());
            $classe->setFiliere($form->get('filiere')->getData());
            $classe->setNiveau($form->get('niveau')->getData());
            $libelle = $classe->getNiveau() . '_' . $classe->getFiliere();
            $classe->setLibelle($libelle);
            $this->om->persist($classe);
            $this->om->flush();
            $this->addFlash('success', 'Classe ajouté avec succès');
            return $this->redirectToRoute('app_classe');
        }
        return $this->render(
            'classe/add.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
