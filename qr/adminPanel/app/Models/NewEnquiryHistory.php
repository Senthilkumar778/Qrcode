<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEnquiryHistory extends Model
{
    use HasFactory;

    protected $table = 'newEnquiryHistory';

    protected $fillable = [
        'newEnquiryID',
        'status',
        'userID',
        'remarks',
        'timeInterval',
        'subcategoryName'
    ];

    public $timestamps = false;
}
