<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            
            // 1) aggiunta colonna alla tabella posts
            $table-> unsignedBigInteger('category_id')->nullable()->after('id');

            // 2) instaurare la relazione
            $table->foreign('category_id')
                    ->references('id')
                    // CASCADE= se viene eliminato un record, di conseguenza(indirettamente) viene eliminato anche l'altro record con il quale è stata instaurata una relazione
                    // per non permettere ciò (quindi quando si elimina una categoria non deve essere eliminato anche il post)-> viene utilizzata la struttura "->onDelete('set null')"
                    ->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            
            // 3) eliminare la relazione instaurata
            $table->dropForeign('posts_category_id_foreign');

            // 4) viene eliminata la colonna
            $table->dropColumn('category_id');
        });
    }
}
