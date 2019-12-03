<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'street', 'unit', 'city', 'state', 'zip', 'user_id'
    ];
}
