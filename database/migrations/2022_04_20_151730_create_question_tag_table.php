<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('question_tag', function (Blueprint $table)
        {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['tag_id']);
        });

        Schema::table('question_tag', function (Blueprint $table) {
            $table->dropColumn('question_id');
            $table->dropColumn('tag_id');
        });

        Schema::dropIfExists('question_tag');
    }
};
