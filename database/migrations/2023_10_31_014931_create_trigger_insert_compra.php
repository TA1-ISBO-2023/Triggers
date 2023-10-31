<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateTriggerInsertCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared("
            CREATE TRIGGER log_insert_compra AFTER INSERT ON compra
            FOR EACH ROW
            BEGIN
	            INSERT INTO log(evento,tabla,fecha_hora) VALUES ('Insercion','compra', now());
            END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS log_insert_compra");
    }
}
