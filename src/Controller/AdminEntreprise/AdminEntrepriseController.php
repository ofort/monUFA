<?php

namespace App\Controller\AdminEntreprise;

use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EntrepriseType;

class AdminEntrepriseController extends AbstractController
{
    /**
     * @Route("/admin/entreprise", name="admin.entreprise.index")
     * @param EntrepriseRepository $entrepriseRepository
     * @return Response
     */
    //Affiche la liste des entreprises pour sélection
    public function index(EntrepriseRepository $entrepriseRepository)
    {
        $entreprises = $entrepriseRepository
            ->findall(); //Recupération de toutes les entreprises dans la base de données

        return $this->render('admin_entreprise/admin_entreprise_index.html.twig', [
            'controller_name' => 'AdminEntrepriseController',
            'entreprises' => $entreprises
        ]);
    }

    /**
     * @Route("/admin/entreprise/{id}", name="admin.entreprise.edit", requirements={"id"="\d+"})
     * @param $id
     * @param EntrepriseRepository $entrepriseRepository
     * @param Request $request
     * @return Response
     */
    public function edit($id, EntrepriseRepository $entrepriseRepository, Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $entreprise = $entrepriseRepository
            ->find($id); // Recherche de l'entreprise à modifier

        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirectToRoute("admin.entreprise.index");
        }

        return $this->render('admin_entreprise/entreprise_edit.html.twig', [
            'title' =>  "Edition de l'apprenti " . $entreprise->getNom(),
            'action' => "Edition de l'apprenti " . $entreprise->getNom(),
            'apprenti' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/entreprise/new", name="admin.entreprise.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $entreprise = new Entreprise(); // creation d'une entreprise

        $form = $this->createForm(EntrepriseType::class, $entreprise); // creation du formulaire
        $form->handleRequest($request); // traitement de la requete

        // traitement du formulaire s'il a été soumis
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($entreprise); // stockage dans la base de donnée du nouvel apprenti
            $em->flush(); // actualisation de la base de donnée
            return $this->redirectToRoute("admin.entreprise.index"); // on retourne vers la liste des entreprise
        }

        //Affichage du formulaire si premier passage
        return $this->render('admin_entreprise/entreprise_edit.html.twig', [
            'title' => 'Ajouter une nouvelle entreprise',
            'action' => "Ajout d'une entreprise",
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

}
