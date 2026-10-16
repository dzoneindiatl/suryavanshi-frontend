<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCountry extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'iso2',
        'iso3',
        'phone_code',
        'exchange_rates',
        'currency_symbol_name',
        'currency_code',
        'currency_symbol',
        'flag',
    ];
}
