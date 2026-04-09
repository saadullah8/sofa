<?php

use App\Models\Review;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->foreignId('stuff_id')->constrained('stuffs')->onDelete('cascade');
            $table->string('name');
            $table->integer('stock');
            $table->integer('price');
            $table->string('image');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
