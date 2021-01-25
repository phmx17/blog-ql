<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
          // create column topic_id, make foreign and reference it to topics table
          $table->unsignedBigInteger('topic_id')->index()->nullable();  // type is of the id; index() improves performance; nullable() only req. for SQLite; default in mySQL
          $table->foreign('topic_id')->references('id')->on('topics');  // the foreign key references id in table topics

          // same Spiel for author_id
          $table->unsignedBigInteger('author_id')->index()->nullable();
          $table->foreign('author_id')->references('id')->on('users');
        });
    }

    // foreign keys are constrained to the type that it references
    // for down() first remove foreign key using []
    // drop the column
    // running this migration will throw error: 'cannot have a null in NOT NULL column; this is a limitation to SQLite only
    // therefore must add ->nullable() (default in mySQL) to add column
    // DB browser shows our 2 new cols added to posts plus the 2 new indeces
    // use a  more expansive DB viewer for details and specs of the foreign keys
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
          // sqlite does not support dropForeign(); use with mySQL!
          // $table->dropForeign(['topic_id']);  // [] because actual name laravel uses in table is unknown; therefore supplying name used for creation from above
          $table->dropColumn('topic_id'); 
        });

        Schema::table('posts', function (Blueprint $table) {  // must use Schema::table again for dropping, but only because of sqlite
          // $table->dropForeign(['author_id']);
          $table->dropColumn('author_id');
        });      
    }
}
