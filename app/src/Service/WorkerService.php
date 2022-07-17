<?php

namespace App\Service;

use DateTime;
use App\Entity\Worker;
use Symfony\Component\HttpFoundation\Request;

class WorkerService
{
    public function create(Request $request)
    {
        $worker = new Worker();
        $worker->setName($request->get('name'));
        $worker->setCreateDateTime(
            new DateTime($request->get('create_date_time')) ?? new DateTime('now')
        );
        $worker->setUpdateDateTime(
            new DateTime($request->get('update_date_time')) ?? new DateTime('now')
        );

        return $worker;
    }

    public function update(Worker $worker, Request $request)
    {
        $worker->setName($request->get('name'));
        $worker->setUpdateDateTime(
            new DateTime($request->get('update_date_time')) ?? new DateTime('now')
        );

        return $worker;
    }
}
