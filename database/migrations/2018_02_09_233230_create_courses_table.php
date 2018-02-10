<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id')->unsigned();
            $table->string("name", 256);
            $table->string("slug", 256)->unique();
            $table->dateTime("start")->nullable()->default(null);
            $table->dateTime("end")->nullable()->default(null);
            $table->boolean("visible")->default(true);
            $table->text("description")->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
            // index & other constraints
            $table->index(['name']);
            $table->index("start");
            $table->index("end");
            $table->index("visible");
            $table->index(["start", "end"]);
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
