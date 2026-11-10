<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInfoHistory extends Model
{
    use HasFactory;

    protected $table = 'serviceInfoHistory';

    protected $fillable = [
        'serviceInfoID',
        'status',
        'userID',
        'remarks',
        'timeInterval',
        'subcategoryName'
    ];

    public $timestamps = false;
}
