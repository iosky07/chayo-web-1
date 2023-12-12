<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $keyType = 'integer';

    protected $fillable = ['file_name', 'customer_id', 'created_at', 'updated_at'];
}
