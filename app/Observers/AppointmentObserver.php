<?php

namespace App\Observers;

use App\Services\CustomClasses\AppCarbon;

class AppointmentObserver
{
    /**
     * Listen to the Appointment updating event.
     *
     * @param  \App\Model  $model
     * @return void
     */
    public function saving($model)
    {
        $start = request('app_date') . ' ' .request('app_start');

        $model->start_at = AppCarbon::createDate($start);
    }
}