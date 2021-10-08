<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 class CreateAccountsTable extends Migration
 {
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
         Schema::create('accounts', function (Blueprint $table) {
             $table->id();
             $table->string('name');
             $table->text('address');
             $table->boolean('checked');
             $table->longText('description');
             $table->text('interest')->nullable();
             $table->date('date_of_birth')->nullable();
             $table->string('email');
             $table->unsignedBigInteger('account');
             $table->json('credit_card');
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
         Schema::dropIfExists('accounts');
     }
 }
