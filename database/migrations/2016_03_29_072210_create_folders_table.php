<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function(Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('modified_by')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE folders ADD FULLTEXT search(name, description)');

        Schema::table('folders', function(Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function($table) {
            $table->dropIndex('search');
            $table->dropForeign('folders_created_by_foreign');
            $table->dropForeign('folders_modified_by_foreign');
        });
        Schema::drop('folders');
    }
}
