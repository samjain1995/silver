<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminModulePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_module_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('permission_key')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->integer('module_id')->default(0);
            $table->integer('rank')->default(0);
            $table->tinyInteger('view_sidebar')->default(0);
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
        Schema::dropIfExists('admin_module_permissions');
    }
}
