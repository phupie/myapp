<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('display_name')->comment('表示名');
            $table->unsignedInteger('main_job')->comment('メインジョブ');
            $table->unsignedInteger('story_progress')->comment('ストーリー進行度');
            $table->string('introduction');
            $table->string('img_path')->nullable()->comment('プロフィール画像');
            $table->string('head_img_path')->nullable()->comment('プロフィールヘッダー画像');
            $table->timestamps();
            
            $table->index('id');
            $table->index('user_id');
            $table->index('display_name');
            $table->index('introduction');
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
