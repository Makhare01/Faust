<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
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
        'comment',
    ];
}
