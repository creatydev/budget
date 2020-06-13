<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'transaction_type',
        'transaction_id',
        'file_path'
    ];
}
