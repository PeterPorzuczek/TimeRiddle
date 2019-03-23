<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('topic_id');

            $table->integer('index');
            $table->string('name');
            $table->text('content')->nullable();
            $table->text('content_no_code')->nullable();
            $table->text('content_html')->nullable();
            $table->text('content_html_no_code')->nullable();
            $table->text('links')->nullable();
            $table->boolean('show_code');
            $table->boolean('public');

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
        Schema::dropIfExists('quests');
    }
}
