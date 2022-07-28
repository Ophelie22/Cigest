<?php

namespace App\Controller;

use App\Entity\Salaries;
use App\Form\SalariesType;
use App\Repository\SalariesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/salaries')]
class SalariesController extends AbstractController
{
    #[Route('/', name: 'app_salaries_index', methods: ['GET'])]
    public function index(SalariesRepository $salariesRepository): Response
    {
        return $this->render('salaries/index.html.twig', [
            'salaries' => $salariesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_salaries_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SalariesRepository $salariesRepository): Response
    {
        $salary = new Salaries();
        $form = $this->createForm(SalariesType::class, $salary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salariesRepository->add($salary, true);

            return $this->redirectToRoute('app_salaries_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('salaries/new.html.twig', [
            'salary' => $salary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salaries_show', methods: ['GET'])]
    public function show(Salaries $salary): Response
    {
        return $this->render('salaries/show.html.twig', [
            'salary' => $salary,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_salaries_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Salaries $salary, SalariesRepository $salariesRepository): Response
    {
        $form = $this->createForm(SalariesType::class, $salary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salariesRepository->add($salary, true);

            return $this->redirectToRoute('app_salaries_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('salaries/edit.html.twig', [
            'salary' => $salary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salaries_delete', methods: ['POST'])]
    public function delete(Request $request, Salaries $salary, SalariesRepository $salariesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salary->getId(), $request->request->get('_token'))) {
            $salariesRepository->remove($salary, true);
        }

        return $this->redirectToRoute('app_salaries_index', [], Response::HTTP_SEE_OTHER);
    }
}
