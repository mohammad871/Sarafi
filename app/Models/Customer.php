<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "table_customer";
    protected $fillable = ['name', 'phone', 'address', 'tazkira'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    use HasFactory;
}
