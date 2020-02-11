<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Gaëtan Rolé-Dubruille <gaetan.role-dubruille@sensiolabs.com>
 * @Route("/classroom", name="app_classroom_")
 */
final class ClassroomController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ClassroomRepository $classroomRepository): Response
    {
        return $this->render('classroom/index.html.twig', ['classrooms' => $classroomRepository->findAll()]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($classroom);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_classroom_index');
        }

        return $this->render('classroom/new.html.twig', [
            'classroom' => $classroom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{uuid}", name="show", methods={"GET"})
     */
    public function show(Classroom $classroom): Response
    {
        return $this->render('classroom/show.html.twig', ['classroom' => $classroom]);
    }

    /**
     * @Route("/{uuid}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classroom $classroom): Response
    {
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_classroom_index');
        }

        return $this->render('classroom/edit.html.twig', [
            'classroom' => $classroom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{uuid}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Classroom $classroom): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classroom->getUuid()->toString(), $request->request->get('_token'))) {
            $this->entityManager->remove($classroom);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_classroom_index');
    }
}
