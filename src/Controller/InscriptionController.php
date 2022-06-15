<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnneeScolaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function register(
        Request $request,
        EntityManagerInterface $om,
        AnneeScolaireRepository $annee
    ) {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $inscription->setAc($this->getUser());
            $annee_en_cours = $annee->findBy(['etat' => 1]);
            $inscription->setAnneeScolaire($annee_en_cours[0]);
            $om->persist($inscription);
            $om->flush();
            $this->addFlash('success', 'Étudiant inscrit avec succès');
            return $this->redirectToRoute('app_etudiant');
        }
        return $this->render(
            'etudiant/add.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
