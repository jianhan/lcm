<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 256);
            $table->string("slug", 256);
            $table->dateTime("start")->nullable()->default(NULL);
            $table->dateTime("end")->nullable()->default(NULL);
            $table->boolean("visible")->default(true);
            $table->text("description")->nullable()->default(NULL);
            $table->softDeletes();
            $table->timestamps();
            // index & other constraints
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
