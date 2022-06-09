<?php

namespace App\Traits;

use App\Models\View;
use App\Models\Visit;
use Request;

trait HasVisits {
    function visit() {
        $id = $this->id;
        $ip = Request::ip();
        $model = $this::class;

        $visit = Visit::where(['visitble_id' => $id, 'ip' => $ip])->first();

        if(is_null($visit)) {
            $visit = new Visit();
            $visit->visitble_id = $id;
            $visit->visitble_type = $model;
            $visit->ip = $ip;
            $visit->user_agent = Request::userAgent();
            $visit->save();
        }



    }

}
