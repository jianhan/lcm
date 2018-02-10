<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
    * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 256);
            $table->string('slug', 256)->unique();
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('visible')->default(true);
            $table->text('description')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
            // index & other constraints
            $table->index(['name']);
            $table->index(['display_order']);
            $table->unique('visible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
