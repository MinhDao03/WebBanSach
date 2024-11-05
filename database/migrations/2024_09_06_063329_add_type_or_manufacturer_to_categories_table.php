<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('type')->nullable()->after('name'); // Thêm cột "type" có thể null
            $table->string('manufacturer')->nullable()->after('type'); // Thêm cột "manufacturer" có thể null
        });
    }
    
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('manufacturer');
        });
    }
    
};
