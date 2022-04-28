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
        Schema::create('question_views', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 50);
            $table->string('user_agent', 200);
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('question_views', function (Blueprint $table)
        {
            $table->dropForeign(['question_id']);
            $table->dropColumn('question_id');

        });

        Schema::dropIfExists('question_views');
    }
};
