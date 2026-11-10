<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "productTable";

    protected $fillable = [
        'productName',
        'description',
        'enquiryFlag'
    ];

    public $timestamps = false;
}
