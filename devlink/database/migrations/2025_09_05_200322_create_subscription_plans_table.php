<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Para monetização dos clientes
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Gratuito", "Premium"
            $table->string('type'); // "freelancer", "client"
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('max_projects')->nullable(); // null = ilimitado
            $table->integer('validity_days')->default(30); // Validade do plano
            $table->boolean('featured_listing')->default(false);
            $table->boolean('priority_support')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plans');
    }
};
