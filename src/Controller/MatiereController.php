<?php

namespace App\Controller;

use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatiereController extends AbstractController
{
    /**
     * @Route("/matiere", name="app_matiere")
     */
    public function index(MatiereRepository $repo): Response
    {
        $matieres = $repo->findAll();
        return $this->render('matiere/index.html.twig', [
            'matieres' => $matieres,
        ]);
    }
}