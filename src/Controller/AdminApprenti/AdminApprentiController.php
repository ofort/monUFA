<?php

namespace App\Controller\AdminApprenti;

use App\Entity\Apprenti;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ApprentiRepository;
use App\Form\ApprentiType;

class AdminApprentiController extends AbstractController
{
    /**
     * @Route("/admin/apprenti", name="admin.apprenti.index")
     * @param ApprentiRepository $apprentiRepository
     * @return Response
     */
    public function index(ApprentiRepository $apprentiRepository)
    {
        $apprentis = $apprentiRepository
            ->findall(); //Recupération de tous les apprentis dans la base de donnée

        return $this->render('admin_apprenti/admin_apprenti_index.html.twig', [
            'controller_name' => 'AdminApprentiController',
            'apprentis' => $apprentis
        ]);
    }

    /**
     * @Route("/admin/apprenti/{id}", name="admin.apprenti.edit", requirements={"id"="\d+"})
     * @param $id
     * @param ApprentiRepository $apprentiRepository
     * @param Request $request
     * @return Response
     */
    public function edit($id, ApprentiRepository $apprentiRepository, Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $apprenti = $apprentiRepository
            ->find($id); // Recherche de l'apprenti à modifier

        $form = $this->createForm(ApprentiType::class, $apprenti);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirectToRoute("admin.apprenti.index");
        }

        return $this->render('admin_apprenti/apprenti_edit.html.twig', [
            'title' =>  "Edition de l'apprenti " . $apprenti->getPrenom() .' '.$apprenti->getNom(),
            'action' => "Edition de l'apprenti " . $apprenti->getPrenom() .' '.$apprenti->getNom(),
            'apprenti' => $apprenti,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/apprenti/new", name="admin.apprenti.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $apprenti = new Apprenti(); // creation d'un apprenti

        $form = $this->createForm(ApprentiType::class, $apprenti); // creation du formulaire
        $form->handleRequest($request); // traitement de la requete

        // traitement du formulaire s'il a été soumis
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($apprenti); // stockage dans la base de donnée du nouvel apprenti
            $em->flush(); // actualisation de la base de donnée
            return $this->redirectToRoute("admin.apprenti.index"); // on retourne vers la liste des apprentis
        }

        //Affichage du formulaire si premier passage
        return $this->render('admin_apprenti/apprenti_edit.html.twig', [
            'title' => 'Ajouter un nouvel apprenti',
            'action' => "Ajout d'un apprenti",
            'apprenti' => $apprenti,
            'form' => $form->createView(),
        ]);
    }

}
