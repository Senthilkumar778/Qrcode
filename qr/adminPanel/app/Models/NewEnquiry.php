<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEnquiry extends Model
{
    use HasFactory;

    protected $table = "newEnquiry";

    protected $fillable = [
        'name', 'email', 'phoneNumber', 'phoneNumber', 'productType','productID',
        'issueDescription', 'locationID', 'locationName', 'regionID',
        'regionName', 'requestTime', 'reqIpAddr','subcategoryName','subcategoryID','status', 'userID','remarks'
    ];

    public $timestamps = false;
}
