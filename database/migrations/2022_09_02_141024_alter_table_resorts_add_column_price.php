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
        Schema::table('resorts', function (Blueprint $table) {
            $table->string('price')->after('room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('resorts', 'price')){
            Schema::table('resorts', function (Blueprint $table) {
                $table->dropColumn('price');
            });
        }
    }
};
