<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Lib\ModelAudit;
class ModelWithAudit extends Model
{
  protected static function booted() {

    static::created(function($item) {
      ModelAudit::saved($item , 'create');
    });

    static::deleting(function($item) { 
      ModelAudit::saved($item , 'deleted');
    });

    static::updating(function ($item) {
      ModelAudit::saved($item ,'updated');
    });
  }

}
