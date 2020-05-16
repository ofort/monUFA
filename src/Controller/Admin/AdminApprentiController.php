<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ApprentiRepository;
use App\Form\ApprentiType;

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
     * @param $id
     * @param ApprentiRepository $apprentiRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($id, ApprentiRepository $apprentiRepository, Request $request)
    {
        $apprenti = $apprentiRepository
            ->find($id);

        $em= $this->getDoctrine()->getManager();

        $form = $this->createForm(ApprentiType::class, $apprenti);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->redirectToRoute('admin.apprenti.index');
        }

        return $this->render('admin_apprenti/apprenti_edit.html.twig', [
            'apprenti' => $apprenti,
            'form' => $form->createView(),
        ]);
    }
}
