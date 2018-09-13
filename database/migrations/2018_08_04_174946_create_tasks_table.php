<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('task_id');
            $table->integer('user_id')->unsigned();
            $table->integer('tab_id')->unsigned();
            $table->string('task');
            $table->enum('do_flg', [0,1])->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->foreign('tab_id')
                  ->references('id')
                  ->on('tabs')
                  ->onDelete('cascade');

            //$table->unique(['user_id', 'tab_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
