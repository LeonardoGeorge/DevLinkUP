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
        Schema::table('profiles', function (Blueprint $table) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->json('skills')->nullable();
                $table->string('portfolio_url')->nullable();
                $table->decimal('hourly_rate', 8, 2)->nullable();
                $table->string('experience_level')->nullable(); 
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['skills', 'portfolio_url', 'hourly_rate', 'experience_level']);
        });
    }
};
