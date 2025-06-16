<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'tbl_account';
    protected $primaryKey = 'account_id';
    public $timestamps = false;

    protected $fillable = [
        'account_name',
        'account_price',
        'account_desc',
        'account_content',
        'category_id',
        'account_status',
        'account_image',
    ];
}
