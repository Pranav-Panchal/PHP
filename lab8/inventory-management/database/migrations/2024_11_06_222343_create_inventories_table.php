<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');  
            $table->string('category');     
            $table->integer('quantity');     
            $table->decimal('price', 8, 2);  
            $table->timestamps();            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
