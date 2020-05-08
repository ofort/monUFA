<?php

namespace App\Controller\Admin;

use App\Entity\Apprenti;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ApprentiRepository;

class AdminApprentiController extends AbstractController
{
    /**
     * @Route("/admin/apprenti", name="admin.apprenti.index")
     */
    public function index(ApprentiRepository $apprentiRepository)
    {
        $apprentis = $apprentiRepository
            ->findall();

        return $this->render('admin_apprenti/index.html.twig', [
            'controller_name' => 'AdminApprentiController',
            'apprentis' => $apprentis
        ]);
    }

    /**
     * @Route("/admin/apprenti/{id}", name="admin.apprenti.edit", requirements={"id"="\d+"})
     */
    public function edit($id, ApprentiRepository $apprentiRepository)
    {
        $apprenti = $apprentiRepository
            ->find($id);

        return $this->render('pages/apprenti_show.html.twig', [
            'apprenti' => $apprenti,
        ]);
    }
}
