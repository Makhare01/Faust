<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Accountoffer extends Model
{
    use HasFactory, LogsActivity;

    protected $primaryKey = 'accountoffer_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    protected $fillable = [
        'status',
        'sort',
        // 'offer_id',
        // 'account',
        // 'offer',
    ];
}
