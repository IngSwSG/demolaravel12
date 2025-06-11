<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIntegerCompletedToTasksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Elimina la columna anterior si existe
            if (Schema::hasColumn('tasks', 'completed')) {
                $table->dropColumn('completed');
            }
        });

        Schema::table('tasks', function (Blueprint $table) {
            // Agrega la columna como integer (0: Pendiente, 1: En Proceso, 2: Completada)
            $table->integer('completed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('completed');
        });
    }
}
