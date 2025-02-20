<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_Parcel extends Model
{
    use HasFactory;

    protected $table = 'new_parcels';

    protected $fillable = [
        'sender_name', 
        'sender_email',
        'sender_address', 
        'sender_contact', 
        'recipient_name',
        'recipient_email', 
        'recipient_address', 
        'recipient_contact', 
        'type',
        'branch_id',
        'staff_id',
        'weight', 
        'height', 
        'length', 
        'width', 
        'price', 
        'reference_number', 
        'created_at',
    ];

    protected $casts = [
        'weight' => 'float',
        'height' => 'float',
        'length' => 'float',
        'width' => 'float',
        'price' => 'float',
        'created_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(New_Branch::class, 'branch_id');
    }

    public function staff()
    {
        return $this->belongsTo(New_staff::class, 'staff_id');
    }

    /**
     * Generate a reference number if not set.
     */
    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($parcel) {
    //         if (is_null($parcel->reference_number)) {
    //             $parcel->reference_number = 'REF-' . time();
    //         }
    //     });
    // }
}
