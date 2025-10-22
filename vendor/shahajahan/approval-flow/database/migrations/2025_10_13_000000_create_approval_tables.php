<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalTables extends Migration
{
    public function up()
    {
        Schema::create('approver_user_role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->enum('type',['user','group','department'])->default('user');
            $table->integer('sl')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('remarks',255)->nullable();
            $table->timestamps();
        });

        Schema::create('approval_role_manage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('role_id');
            $table->enum('role_type',['approver','reviewer','verifier'])->default('approver');
            $table->integer('access_forward')->nullable();
            $table->integer('access_backward')->nullable();
            $table->foreign('role_id')->references('id')->on('approver_user_role')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('approval_role_manage');
        Schema::dropIfExists('approver_user_role');
    }
}
