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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->integer('role')->default(0);
            $table->integer('estatus')->default(1);
            $table->text('permisos')->nullable();
            $table->integer('plataforma')->default(0);
            $table->timestamps();
        });

        DB::table("users")
            ->insert([
                "name" => "Yonathan Castillo",
                "email" => "leothan522@gmail.com",
                "email_verified_at" => \Carbon\Carbon::now(),
                "password" => \Illuminate\Support\Facades\Hash::make("20025623"),
                "role" => 100,
                "estatus" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
