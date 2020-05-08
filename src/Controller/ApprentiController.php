<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ApprentiRepository;


class ApprentiController extends AbstractController
{


    /**
     * @Route("/apprenti", name="apprenti.index", )
     * @param ApprentiRepository $apprentiRepository
     * @return Response
     */
	public function index(ApprentiRepository $apprentiRepository)
	{
	    $apprentis = $apprentiRepository
            ->findall();

		return $this->render('pages/apprentis.html.twig', [
		    'apprentis' => $apprentis,
        ]);
	}

    /**
     * @Route("/apprenti/{id}", name="apprenti.show", requirements={"id"="\d+"})
     * @param $id
     * @param ApprentiRepository $apprentiRepository
     * @return Response
     */
    public function show($id, ApprentiRepository $apprentiRepository)
    {
        $apprenti = $apprentiRepository
            ->find($id);

        return $this->render('pages/apprenti_show.html.twig', [
            'apprenti' => $apprenti,
        ]);
    }
}