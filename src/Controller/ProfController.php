<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Form\ProfType;
use App\Repository\ProfRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfController extends AbstractController
{
    /**
     * @Route("/prof", name="app_prof")
     */
    public function index(ProfRepository $repo): Response
    {
        $profs = $repo->findAll();
        return $this->render('prof/index.html.twig', [
            'profs' => $profs,
        ]);
    }
    /**
     * @Route("/prof/create", name="app_createprof")
     */
    public function create(ProfRepository $er, Request $request)
    {

        $prof = new Prof;

        $formulaire = $this->createForm(ProfType::class, $prof);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $er->add($prof);
            return $this->redirectToRoute('app_prof');
        } else {
            return $this->render('prof/formulaire.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }
    /**
     * @Route("/prof{id}/delete", name="app_deleteprof")
     */
    public function delete($id, ProfRepository $er)
    {
        $prof = $er->find($id);
        $er->remove($prof);

        return $this->redirectToRoute('app_prof');
    }
}