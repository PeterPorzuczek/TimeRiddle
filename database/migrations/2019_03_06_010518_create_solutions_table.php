<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('problem_id');

            $table->string('mark')->nullable();
            $table->string('link');
            $table->string('password');
            $table->text('summary')->nullable();
            $table->text('summary_no_code')->nullable();
            $table->text('summary_html')->nullable();
            $table->text('summary_html_no_code')->nullable();

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
        Schema::dropIfExists('solutions');
    }
}
