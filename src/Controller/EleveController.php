<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EleveController extends AbstractController
{
    /**
     * @Route("/eleve", name="liste")
     */
    public function liste(EleveRepository $repo): Response
    {
        $eleves = $repo->findAll();
        return $this->render('eleve/index.html.twig', [
            'eleves' => $eleves,
        ]);
    }
    /**
     * @Route("/eleve/create", name="app_createeleve")
     */
    public function create(EleveRepository $er, Request $request)
    {

        $eleve = new Eleve;

        $formulaire = $this->createForm(EleveType::class, $eleve);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $er->add($eleve);
            return $this->redirectToRoute('liste');
        } else {
            return $this->render('prof/formulaire.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }
    /**
     * @Route("/eleve{id}/details", name="app_detailseleve")
     */
    public function details($id, EleveRepository $er)
    {
        $eleve = $er->find($id);

        return $this->render('eleve/details.html.twig', [
            'eleve' => $eleve,
        ]);
    }
    /**
     * @Route("/eleve{id}/delete", name="app_deleteeleve")
     */
    public function delete($id, EleveRepository $er)
    {
        $prof = $er->find($id);
        $er->remove($prof);

        return $this->redirectToRoute('liste');
    }
}