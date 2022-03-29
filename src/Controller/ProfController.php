<?php

namespace App\Controller;

use App\Repository\ProfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}