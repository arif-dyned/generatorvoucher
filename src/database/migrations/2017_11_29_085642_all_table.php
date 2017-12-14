<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('organization_level')) {
            Schema::create('organization_level', function (Blueprint $table) {
                $table->increments('id');
                $table->string('organization_level_name', 255);
                $table->timeStamps();
            });
        }
        if (!Schema::hasTable('grade')) {
            Schema::create('grade', function (Blueprint $table) {
                $table->increments('id');
                $table->string('grade_name', 255);
                $table->timeStamps();
            });
        }
        if (!Schema::hasTable('position')) {
            Schema::create('position', function (Blueprint $table) {
                $table->increments('id');
                $table->string('position_name', 255);
                $table->timeStamps();
            });
        }
        if (!Schema::hasTable('cost_center')) {
            Schema::create('cost_center', function (Blueprint $table) {
                $table->increments('id');
                $table->string('cost_center_name', 255);
                $table->timeStamps();
            });
        }
        if (!Schema::hasTable('employee')) {
            Schema::create('employee', function (Blueprint $table) {
                $table->increments('id');
                $table->string('employee_code', 255)->unique();
                $table->string('employee_name', 255);
                $table->integer('grade_id')->unsigned()->nullable();
                $table->integer('cost_center_id')->unsigned()->nullable();
                $table->integer('position_id')->unsigned()->nullable();
                $table->string('email', 255)->nullable();
                $table->integer('organization_level_id')->unsigned()->nullable();
                $table->integer('organization_id')->unsigned()->nullable();
                $table->string('voucher_code', 255)->nullable();
                $table->enum('status', ['active','non-active'])->nullable();
                $table->timeStamps();
            });
        }
        if (!Schema::hasTable('organization')) {
            Schema::create('organization', function (Blueprint $table) {
                $table->increments('id');
                $table->string('organization_code', 255)->unique()->nullable();
                $table->string('organization_name', 255);
                $table->string('cost_center', 255)->nullable();
                $table->string('email', 255)->nullable();
                $table->enum('type_voucher', ['all', 'personal']);
                $table->string('voucher_code', 255)->nullable();
                $table->timeStamps();
            });
        }
        if (!Schema::hasTable('voucher')) {
            Schema::create('voucher', function (Blueprint $table) {
                $table->increments('id');
                $table->string('voucher_code', 255)->unique();
                $table->integer('organization_id')->unsigned()->nullable();
                $table->integer('employee_id')->unsigned()->nullable();
                $table->timeStamps();
            });
        }
        if (!Schema::hasTable('user')) {
            Schema::create('user', function (Blueprint $table) {
                $table->increments('id');
                $table->string('username', 255);
                $table->string('password', 255);
                $table->string('email', 255);
                $table->timeStamps();
            });
        }


        // table animations add foreign key
        Schema::table('employee', function ($table) {
            $table->foreign('organization_level_id', 'orga_foreign_id')
                ->references('id')->on('organization_level')
                ->onDelete('cascade');

            $table->foreign('grade_id', 'grade_foreign_id')
                ->references('id')->on('grade')
                ->onDelete('cascade');

            $table->foreign('position_id', 'position_foreign_id')
                ->references('id')->on('position')
                ->onDelete('cascade');

            $table->foreign('cost_center_id', 'cost_center_foreign_id')
                ->references('id')->on('cost_center')
                ->onDelete('cascade');

            $table->foreign('organization_id', 'organization_center_foreign_id')
                ->references('id')->on('organization')
                ->onDelete('cascade');
        });


        Schema::table('voucher', function ($table) {
            $table->foreign('organization_id', 'orgav_foreign_id')
                ->references('id')->on('organization')
                ->onDelete('cascade');

            $table->foreign('employee_id', 'employev_foreign_id')
                ->references('id')->on('employee')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee', function ($table) {
            $table->dropForeign('orga_foreign_id');
            $table->dropForeign('grade_foreign_id');
            $table->dropForeign('position_foreign_id');
            $table->dropForeign('cost_center_foreign_id');
        });
        Schema::table('organization', function ($table) {
            $table->dropForeign('employee_foreign_id');
        });
        Schema::table('voucher', function ($table) {
            $table->dropForeign('orgav_foreign_id');
            $table->dropForeign('employev_foreign_id');
        });

        Schema::dropIfExists('employee');
        Schema::dropIfExists('organization');
        Schema::dropIfExists('voucher');
        Schema::dropIfExists('grade');
        Schema::dropIfExists('position');
        Schema::dropIfExists('organization_level');
        Schema::dropIfExists('user');
    }
}
