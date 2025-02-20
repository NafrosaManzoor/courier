<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_Branch extends Model
{
    use HasFactory;
    protected $table = 'new_branches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id',
        'street',
        'city',
        'state',
        'zip_code',
        'country',
        'contact',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function staff()
{
   
        return "{$this->branch_id},{$this->street}, {$this->city}, {$this->state}, {$this->zip_code}, {$this->country}";
    
}

public function branch()
{
    return $this->belongsTo(New_Branch::class, 'branch_processed'); // Assuming 'branch_processed' is the foreign key
}

}



