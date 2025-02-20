<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_staff extends Model
{
    use HasFactory;
    protected $table = 'new_staffs';

    protected $fillable = [
        'staff_id',
        'first_name', 
        'last_name', 
        'branch_id', 
        'email', 
        'password'
    ];

    // // Relationship with Branch
    public function branch()
    {
        return $this->belongsTo(New_Branch::class);
    }

}
