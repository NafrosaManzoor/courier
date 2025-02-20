<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('new_parcels', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('sender_address');
            $table->string('sender_contact');
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->string('recipient_address');
            $table->string('recipient_contact');
            
            // Enum field with default value
            $table->enum('type', [
                'item_accepted', 
                'collected', 
                'shipped', 
                'in_transit', 
                'arrived_at_destination', 
                'out_for_delivery', 
                'ready_to_pickup', 
                'delivered', 
                'picked_up', 
                'unsuccessful_delivery'
            ])->default('item_accepted');
            
            // Admin-specific fields (nullable)
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('price')->nullable();
            
            // Reference number can be null initially, unique when populated
            $table->string('reference_number')->unique()->nullable();
            
            // Foreign keys (nullable for initial user form submission)
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_parcels');
    }
};
