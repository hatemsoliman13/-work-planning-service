<?php

namespace App\Serive;

use DateTime;
use App\Entity\Worker;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class WorkerService
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Request $request)
    {
        $worker = new Worker();
        $worker->setName($request->get('name'));
        $worker->setCreateDateTime(new DateTime('now'));
        $worker->setUpdateDateTime(new DateTime('now'));

        $this->entityManager->persist($worker);
        return $worker;
    }

    public function update(Worker $worker, Request $request)
    {
        $worker->setName($request->get('name'));
        $worker->setUpdateDateTime(new DateTime());

        return $worker;
    }
}
