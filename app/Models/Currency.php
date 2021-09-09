<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['currency_name', 'currency_html_symbol', 'short_code', 'active'];

    protected $hidden = ['updated_at', 'delete_at', 'created_at'];

}
