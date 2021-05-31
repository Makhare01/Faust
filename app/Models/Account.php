<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        // ->logOnly(['account_login', 'account_pwd', 'ssh_ip', 'ssh_port', 'ssh_login', 'ssh_pwd', 'city', 'zip', 'comment',]);
        ->logFillable();
    }

    protected $fillable = [
        'account_login',
        'account_pwd',
        'ssh_ip',
        'ssh_port',
        'ssh_login',
        'ssh_pwd',
        'city',
        'zip',
        'state',
        'comment',
        'status',
        'country_code',
        'country',
        'company_created_date'
    ];
}
