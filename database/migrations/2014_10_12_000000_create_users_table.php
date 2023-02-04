<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nom');
            $table->string('prenom');
            $table->boolean('actif')->default(1);
            $table->timestamp('date_creation')->useCurrent();
            $table->unsignedBigInteger('group_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }

}
