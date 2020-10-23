<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'itemName', 'itemPrice', 'itemQuantity', 'storeId',
    ];
}
