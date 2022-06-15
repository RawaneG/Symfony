<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    public function __construct(EntityManagerInterface $om)
    {
        $this->om = $om;
    }
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $module = $repo->findAll();
        $modulePaginator = $paginator->paginate(
            $module,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render(
            'module/index.html.twig',
            [
                'controller_name' => 'ModuleController',
                'modules' => $modulePaginator
            ]
        );
    }
    #[Route('/module/add', name: 'app_module.add')]
    public function create(Request $request)
    {
        $module = new Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $module = $form->getData();
            $this->om->persist($module);
            $this->om->flush();
            $this->addFlash('success', 'Module ajouté avec succès');
            return $this->redirectToRoute('app_module');
        }
        return $this->render(
            'module/add.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
