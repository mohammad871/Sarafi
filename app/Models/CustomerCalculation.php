<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCalculation extends Model
{
    protected $table = 'table_customer_deal';
    protected $fillable = ['customer_id', 'type', 'money', 'currency', 'description', 'date'];
    public $timestamps = false;
    use HasFactory;
}
