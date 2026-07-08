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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['sale', 'rent']);
            $table->enum('category', ['apartment', 'villa', 'independent_house', 'plot', 'penthouse', 'studio_apartment'])->default('apartment')->index();
            $table->decimal('price', 12, 2);
            $table->string('city')->index();
            $table->string('area')->index();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedInteger('size_sqft')->nullable();
            $table->enum('furnishing', ['furnished', 'semi_furnished', 'unfurnished'])->nullable();
            $table->enum('preferred_for', ['family', 'bachelor', 'company_lease'])->nullable();
            $table->enum('possession_status', ['ready_to_move', 'under_construction'])->nullable();
            $table->json('images')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->string('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
