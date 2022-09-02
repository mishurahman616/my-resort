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
        Schema::table('resort_images', function (Blueprint $table) {
            $table->foreignIdFor(Resort::class, 'resort_id')->after('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('resort_images', 'resort_id')){
            Schema::table('resort_images', function (Blueprint $table) {
                $table->dropColumn('resort_id');
            });
        }
    }
};
