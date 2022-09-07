<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoClipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_clips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->string('standard', 4)->comment('PAL or NTSC');
            $table->string('definition', 12)->comment('SD or HD');
            $table->text('description')->comment('Description');
            $table->string('start', 12)->comment('Timecode start HH:MM:ss:ff');
            $table->string('end', 12)->comment('Timecode start HH:MM:ss:ff');
            $table->integer('duration')->comment('Duration in frames');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('reel_id');
            $table->timestamps();

            $table->foreign('reel_id')->references('id')->on('reels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_clips');
    }
}
