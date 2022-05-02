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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('text', 2000);
//            $table->unsignedInteger('likeCount')->default(0);
//            $table->unsignedInteger('dislikeCount')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('viewCount')->default(0);
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

        Schema::table('questions', function (Blueprint $table)
        {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

        });

        Schema::dropIfExists('questions');
    }
};
