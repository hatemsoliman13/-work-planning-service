<?php

namespace App\Tests\Service;

use App\Entity\Shift;
use App\Entity\Worker;
use App\Service\ShiftService;
use App\Service\WorkerService;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ShiftServiceTest extends TestCase
{
    public function testCreate()
    {
        $request = $this->getRequest();
        $shiftService = new ShiftService();
        $createdShift = $shiftService->create($this->getWorker($request), $request);

        $this->assertEquals($createdShift, $this->getShift($request));
    }

    public function testUpdate()
    {
        $shiftService = new ShiftService();
        $updateRequest = $this->getRequest([
            'name' => 'Bob Marley',
            'shift_date' => '2022-07-20',
            'shift_hours' => '16-24'
        ]);
        $updatedShift = $shiftService->update(
            $this->getShift($this->getRequest()), $updateRequest
        );
        $this->updateWorker($updatedShift->getWorker(), $updateRequest);
        $this->assertEquals($this->getShift($updateRequest), $updatedShift);
    }

    private function getRequest(array $requestData = []): Request
    {
        return new Request([
            'name' => $requestData['name'] ?? 'Joe Doe',
            'shift_date' => $requestData['shift_date'] ?? '2022-07-18',
            'shift_hours' => $requestData['shift_hours'] ?? '00-00',
            'create_date_time' => $requestData['create_date_time'] ?? '2022-07-18',
            'update_date_time' => $requestData['update_date_time'] ?? '2022-07-18'
        ]);
    }

    private function getWorker(Request $request): Worker
    {
        $worker = new Worker();
        $worker->setName($request->get('name'))
            ->setCreateDateTime(new DateTime($request->get('create_date_time')))
            ->setUpdateDateTime(new DateTime($request->get('update_date_time')));

        return $worker;
    }

    private function getShift(Request $request): Shift
    {
        $expectedShift = new Shift();
        $expectedShift->setWorker($this->getWorker($request))
            ->setShiftDateTime(new DateTime($request->get('shift_date')))
            ->setShiftHours($request->get('shift_hours'))
            ->setCreateDateTime(new DateTime($request->get('create_date_time')))
            ->setUpdateDateTime(new DateTime($request->get('update_date_time')));

        return $expectedShift;
    }

    private function updateWorker(Worker $worker, Request $request): void
    {
        $workerService = new WorkerService();
        $workerService->update($worker, $request);
    }
}
