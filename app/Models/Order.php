<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'account_id', 'account_name', 'account_desc', 'account_content', 'account_price' ,
    ];

    public function user() {
    return $this->belongsTo(User::class, 'user_id');
    }
}
