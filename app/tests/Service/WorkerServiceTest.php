<?php

namespace App\Tests\Service;

use App\Entity\Worker;
use App\Service\WorkerService;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class WorkerServiceTest extends TestCase
{
    public function testCreate()
    {
        $request = $this->getRequest();
        $workerService = new WorkerService();
        $createdWorker = $workerService->create($request);

        $this->assertEquals($createdWorker, $this->getWorker($request));
    }

    public function testUpdate()
    {
        $originalWorker = $this->getWorker($this->getRequest());
        $workerService = new WorkerService();
        $updateRrequest = $this->getRequest([
            'name' => 'Johnny Cash'
        ]);
        $updatedWorker = $workerService->update($originalWorker, $updateRrequest);

        $this->assertEquals($updatedWorker, $this->getWorker($updateRrequest));
    }

    private function getWorker(Request $request): Worker
    {
        $worker = new Worker();
        $worker->setName($request->get('name'))
            ->setCreateDateTime(new DateTime($request->get('create_date_time')))
            ->setUpdateDateTime(new DateTime($request->get('update_date_time')));

        return $worker;
    }

    private function getRequest(array $requestData = []): Request
    {
        return new Request([
            'name' => $requestData['name'] ?? 'Joe Doe',
            'create_date_time' => $requestData['create_date_time'] ?? '2022-07-18',
            'update_date_time' => $requestData['update_date_time'] ?? '2022-07-18'
        ]);
    }
}
