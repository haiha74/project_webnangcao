<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration

{
    public function up(): void
    {
        Schema::create('tbl_account', function (Blueprint $table) {
            $table->increments('account_id');
            $table->string('account_name');
            $table->string('account_price');
            $table->text('account_desc');
            $table->text('account_content');
            $table->string('account_image');
            $table->integer('category_id');
            $table->integer('account_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_account');
    }
}
