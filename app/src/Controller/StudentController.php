<?php

namespace App\Controller;

use App\Services\Calcul;
use \DateTime;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author EducManagement <educ.management@domain.fr>
 * @Route("/student", name="app_student_")
 */
final class StudentController extends AbstractController
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
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->render('student/index.html.twig', ['students' => $studentRepository->findAll()]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, Calcul $calcul): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student->setAverage($calcul->average($student->getFirstMark(), $student->getSecondMark()));
            $this->entityManager->persist($student);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_student_index');
        }

        return $this->render('student/new.html.twig', ['student' => $student, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{uuid}", name="show", methods={"GET"})
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', ['student' => $student]);
    }

    /**
     * @Route("/{uuid}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student, Calcul $calcul): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student->setAverage($calcul->average($student->getFirstMark(), $student->getSecondMark()));
            $student->setUpdatedAt(new DateTime());
            $this->entityManager->flush();

            return $this->redirectToRoute('app_student_index');
        }

        return $this->render('student/edit.html.twig', ['student' => $student, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{uuid}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getUuid()->toString(), $request->request->get('_token'))) {
            $this->entityManager->remove($student);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_student_index');
    }
}
