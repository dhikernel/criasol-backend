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
        Schema::table('scheduling', function (Blueprint $table) {
            $table->integer('doctor_id')->after('id')->unsigned()->comment('chave estrangeira para o id do médico')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctor')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheduling', function (Blueprint $table) {
            $table->dropForeign('scheduling_doctor_id_foreign');
            $table->dropColumn('doctor_id');
        });
    }
};
