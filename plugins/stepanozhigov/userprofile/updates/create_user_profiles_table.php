<?php namespace Stepanozhigov\Userprofile\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateUserProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('stepanozhigov_userprofile_user_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('about')->nullable();
            $table->text('interests')->nullable();
            $table->text('skills')->nullable();
            $table->text('qualifications')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stepanozhigov_userprofile_user_profiles');
    }
}
