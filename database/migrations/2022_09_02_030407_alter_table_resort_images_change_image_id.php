<?php

use App\Models\Admin\Resort;
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
        if(Schema::hasColumn('resort_images', 'resort_id')){
            Schema::table('resort_images', function (Blueprint $table) {
                $table->dropColumn('resort_id');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resort_images', function (Blueprint $table) {
            $table->string('resort_id');
        });
    }
};
