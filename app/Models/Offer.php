<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory, LogsActivity;
    protected $primaryKey = 'offer_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
    }

    protected $fillable = [
        'key',
        'adds_text',
        'bid',
        'comment',
        'status',
    ];
}
