<?php

namespace App\Controller;

use App\Repository\ApprentiRepository;
use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise", name="entreprise.index")
     * @param EntrepriseRepository $entrepriseRepository
     * @return Response
     */
    public function index(EntrepriseRepository $entrepriseRepository)
    {
        $entreprises = $entrepriseRepository
            ->findAll();
        return $this->render('entreprise/entreprise_index.html.twig', [
            'controller_name' => 'EntrepriseController',
            'entreprises'     => $entreprises,
        ]);
    }
    /**
     * @Route("/entreprise/{id}", name="entreprise.show", requirements={"id"="\d+"})
     * @param $id
     * @param EntrepriseRepository $entrepriseRepository
     * @return Response
     */
    public function show($id, EntrepriseRepository $entrepriseRepository)
    {
        $entreprise = $entrepriseRepository
            ->find($id);

        return $this->render('entreprise/entreprise_show.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }
}
