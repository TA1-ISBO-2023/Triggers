<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->string("precio");
            $table->timestamps();
        });

        DB::unprepared("
            CREATE TRIGGER log_insert_compra AFTER INSERT ON compra
            FOR EACH ROW
            BEGIN
	            INSERT INTO log(evento,tabla,fecha_hora) VALUES ('Insercion','compra', now());
            END"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
        DB::unprepared("DROP TRIGGER IF EXISTS log_insert_compra");
    }
}
