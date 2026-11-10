<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInfo extends Model
{
    use HasFactory;

    protected $table = "serviceInfo";

    protected $fillable = [
        'name', 'email', 'phoneNumber', 'phoneNumber', 'productType','productID',
        'issueDescription', 'locationID', 'locationName', 'regionID',
        'regionName', 'issueImages', 'requestTime', 'reqIpAddr','subcategoryName','subcategoryID', 'status','userID',
        'remarks'

    ];
    
    protected $casts = [
        'createdAt' => 'datetime',
    ];

    public $timestamps = false;
}
