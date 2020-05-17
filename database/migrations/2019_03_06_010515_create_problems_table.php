<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('quest_id');

            $table->integer('index');
            $table->string('name');
            $table->text('content')->nullable();
            $table->text('content_no_code')->nullable();
            $table->text('content_html')->nullable();
            $table->text('content_html_no_code')->nullable();
            $table->text('links')->nullable();
            $table->boolean('show_code');
            $table->boolean('public');

            $table->string('passwords')->nullable();

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
        Schema::dropIfExists('problems');
    }
}
