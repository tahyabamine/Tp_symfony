<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    /**
     * @Route("/classe", name="app_classe")
     */
    public function index(ClasseRepository $repo): Response
    {
        $classes = $repo->findAll();
        return $this->render('classe/index.html.twig', [
            'classes' => $classes,
        ]);
    }
    /**
     * @Route("/classe/create", name="app_createclasse")
     */
    public function create(ClasseRepository $er, Request $request)
    {

        $classe = new Classe;

        $formulaire = $this->createForm(ClasseType::class, $classe);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $er->add($classe);
            return $this->redirectToRoute('app_classe');
        } else {
            return $this->render('prof/formulaire.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }
}