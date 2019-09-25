<?php

namespace App\Controller;

use App\Entity\GroupUser;
use App\Form\GroupType;
use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/group")
 */
class GroupController extends AbstractController
{
    /**
     * @Route("/", name="group_index", methods={"GET"})
     */
    public function index(GroupRepository $groupRepository): Response
    {
        return $this->render(
            'group/index.html.twig',
            [
                'groups' => $groupRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="group_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $group = new GroupUser();
        $form  = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($group);
            $entityManager->flush();

            return $this->redirectToRoute('group_index');
        }

        return $this->render(
            'group/new.html.twig',
            [
                'group' => $group,
                'form'  => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="group_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GroupUser $group): Response
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('group_index');
        }

        return $this->render(
            'group/edit.html.twig',
            [
                'group' => $group,
                'form'  => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/delete", name="group_delete", methods={"GET","DELETE"})
     */
    public function delete(Request $request, GroupUser $group): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($group);
        $entityManager->flush();

        return $this->redirectToRoute('group_index');
    }
}
