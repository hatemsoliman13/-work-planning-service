<?php

namespace App\Controller;

use App\Entity\Shift;
use App\Entity\Worker;
use App\Serive\ShiftService;
use App\Serive\WorkerService;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShiftController extends AbstractController
{
    /**
     * @Route("/", name="index_shifts", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $shiftRepo = $entityManager->getRepository(Shift::class);
        $shifts = $shiftRepo->findBy([], ['shiftDateTime' => 'DESC']);

        return $this->render('shifts/index.html.twig', ['shifts' => $shifts]);
    }

    /**
     * @Route("/create", name="create_shift", methods={"POST", "GET"})
     */
    public function create(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {

        if ($request->getMethod() === 'GET') {
            return $this->render('/shifts/create.html.twig');
        }

        $submittedToken = $request->request->get('token');

        if (!$this->isCsrfTokenValid('create-shift', $submittedToken)) {
            $this->addFlash('notice', 'Your request was refused');
            return $this->redirectToRoute('index_shifts');
        }

        $worker = $entityManager->getRepository(Worker::class)->findOneBy([
            'name' => $request->get('name')
        ]);

        if (empty($worker)) {
            $workerService = new WorkerService();
            $worker = $workerService->create($request);
        }

        $shiftService = new ShiftService();
        $shift = $shiftService->create($worker, $request);

        $entityManager->persist($worker);
        $entityManager->persist($shift);

        try {
            $entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            $this->addFlash(
                'notice',
                'Worker is not free!'
            );
            return $this->render('/shifts/create.html.twig');
        }

        $this->addFlash(
            'notice',
            'Created Successfully!'
        );
        return $this->redirectToRoute('index_shifts');
    }

    /**
     * @Route("/show/{id}", name="show_shift", methods={"GET"})
     */
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $shift = $entityManager->find(Shift::class, $id);

        return $this->render('shifts/show.html.twig', ['shift' => $shift]);
    }

    /**
     * @Route("/update/{id}", name="update_shift", methods={"POST", "GET"})
     */
    public function update(
        EntityManagerInterface $entityManager,
        Request $request,
        int $id
    ): Response {
        $shift = $entityManager->find(Shift::class, $id);

        if ($request->getMethod() === 'GET') {
            return $this->render('shifts/update.html.twig', ['shift' => $shift]);
        }

        $submittedToken = $request->request->get('token');

        if (!$this->isCsrfTokenValid('update-shift', $submittedToken)) {
            $this->addFlash(
                'notice',
                'Your request was refused'
            );
            return $this->redirectToRoute('index_shifts');
        }

        $workerService = new WorkerService();
        $workerService->update($shift->getWorker(), $request);

        $shiftService = new ShiftService();
        $shiftService->update($shift, $request);

        try {
            $entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            $this->addFlash(
                'notice',
                'Worker is not free!'
            );
            return $this->render(
                'shifts/update.html.twig', ['shift' => $shift]
            );
        }

        $this->addFlash(
            'notice',
            'Updated Successfully!'
        );
        return $this->redirectToRoute('index_shifts');
    }

    /**
     * @Route("/delete/{id}", name="delete_shift", methods={"POST"})
     */
    public function delete(EntityManagerInterface $entityManager, Request $request, int $id): Response
    {
        $submittedToken = $request->request->get('token');

        if (!$this->isCsrfTokenValid('delete-shift', $submittedToken)) {
            $this->addFlash(
                'notice',
                'Your request was refused'
            );
            return $this->redirectToRoute('index_shifts');
        }

        $entityManager->remove($entityManager->find(Shift::class, $id));
        $entityManager->flush();

        return $this->redirectToRoute('index_shifts');
    }
}
