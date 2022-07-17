<?php

namespace App\Service;

use App\Entity\Shift;
use DateTime;
use App\Entity\Worker;
use Symfony\Component\HttpFoundation\Request;

class ShiftService
{
    public function create(Worker $worker, Request $request)
    {
        $shift = new Shift();
        $shift->setWorker($worker);
        $shift->setShiftHours($request->get('shift_hours'));
        $shift->setShiftDateTime(new DateTime($request->get('shift_date')));
        $shift->setCreateDateTime(
            new DateTime($request->get('create_date_time')) ?? new DateTime('now')
        );
        $shift->setUpdateDateTime(
            new DateTime($request->get('update_date_time')) ?? new DateTime('now')
        );

        return $shift;
    }

    public function update(Shift $shift, Request $request)
    {
        $shift->setWorker($shift->getWorker());
        $shift->setShiftHours($request->get('shift_hours'));
        $shift->setShiftDateTime(new DateTime($request->get('shift_date')));
        $shift->setUpdateDateTime(
            new DateTime($request->get('update_date_time')) ?? new DateTime('now')
        );

        return $shift;
    }
}
