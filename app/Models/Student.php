<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['reg_no', 'name', 'email', 'phone', 'address', 'batch_id'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
