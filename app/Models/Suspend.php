<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspend extends Model
{
    use HasFactory;
    public $primaryKey  = 'id';

    protected $fillable = [
        'rows',
        'sort',
    ];
}
