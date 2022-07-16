<?php

namespace App\Serive;

use DateTime;
use App\Entity\Worker;
use Symfony\Component\HttpFoundation\Request;

class WorkerService
{
    public function create(Request $request)
    {
        $worker = new Worker();
        $worker->setName($request->get('name'));
        $worker->setCreateDateTime(new DateTime('now'));
        $worker->setUpdateDateTime(new DateTime('now'));

        return $worker;
    }

    public function update(Worker $worker, Request $request)
    {
        $worker->setName($request->get('name'));
        $worker->setUpdateDateTime(new DateTime());

        return $worker;
    }
}
