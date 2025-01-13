<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nickname', 255);
            $table->string('login', 255)->unique();
            $table->string('password', 255);
            $table->string('path_icon')->nullable();
            $table->timestamps();
        });
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description');
            $table->string('path_icon')->nullable();
            $table->timestamps();
        });
        Schema::create('user_achievement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('achievement_id')->constrained('achievements');
            $table->timestamps();
        });
        Schema::create('roles_admin', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nickname', 255);
            $table->string('login', 255)->unique();
            $table->string('password', 255);
            $table->string('path_icon')->nullable();
            $table->foreignId('role_id')->constrained('roles_admin');
            $table->timestamps();
        });
        Schema::create('curs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description');
            $table->text('purpose');
            $table->integer('average_completion_time')->nullable();
            $table->string('path_icon')->nullable();
            $table->timestamps();
        });
        Schema::create('steps_of_curs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description');
            $table->integer('average_completion_time')->nullable();
            $table->foreignId('curs_id')->constrained('curs')->onDelete('cascade');
            $table->foreignId('previous_id')->nullable()->constrained('steps_of_curs')->onDelete('set null');
            $table->timestamps();
        });
        Schema::table('curs', function (Blueprint $table) {
            $table->foreignId('first_step_id')->nullable()->constrained('steps_of_curs')->onDelete('set null');
        });
        Schema::create('step_urls', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->foreignId('step_id')->constrained('steps_of_curs');
            $table->timestamps();
        });
        Schema::create('selected_curs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('curs_id')->constrained('curs');
            $table->float('progress', 4, 1);
            $table->boolean('is_finish');
            $table->datetime('date_of_finish')->nullable();
            $table->timestamps();
        });
        Schema::create('progress_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('step_id')->constrained('steps_of_curs');
            $table->boolean('is_finish');
            $table->datetime('date_of_finish')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_user');
        Schema::dropIfExists('selected_curs');
        Schema::dropIfExists('curs');
        Schema::dropIfExists('step_urls');
        Schema::dropIfExists('steps_of_curs');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('roles_admin');
        Schema::dropIfExists('user_achievement');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('users');
    }
};
