<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public $timestamps = false;
    protected $table = 'table_items';
    protected $fillable = ['user_id', 'customer_id', 'company_name', 'buy_money', 'buy_currency', 'sell_money', 'sell_currency', 'description', 'buy_type', 'date'];
    use HasFactory;
}
