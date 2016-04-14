<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function(Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('path');
            $table->integer('created_by')->unsigned();
            $table->integer('modified_by')->unsigned();
            $table->integer('folder_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
            $table->foreign('folder_id')->references('id')->on('folders');
        });

        DB::statement('ALTER TABLE files ADD FULLTEXT search(name, description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function($table) {
            $table->dropIndex('search');
            $table->dropForeign('files_created_by_foreign');
            $table->dropForeign('files_modified_by_foreign');
            $table->dropForeign('files_folder_id_foreign');
        });
        Schema::drop('files');
    }
}
