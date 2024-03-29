<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $timestamps = false;
    protected $table = "table_note";
    protected $fillable = ['title', 'note'];
    use HasFactory;
}
