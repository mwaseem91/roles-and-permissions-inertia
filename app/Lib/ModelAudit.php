<?php

namespace App\Lib;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ModelAudit
{
    public static function saved(Model $model, $action)
    {

        if (Auth::check()) {
            $data['name'] = $model->referring_company ?? $model->name;
            $data['model_id'] = $model->id;
            $data['action'] =  $action;
            $data['audit_by'] = Auth::check() ? Auth::id() : NULL;
            $data['audit_at'] = new DateTime;

            DB::table($model->getTable() . '_audits')->insert($data);
        }
    }
}
