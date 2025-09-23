<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $stateQutoed = array_map(function ($state) {
            return "'$state'";
        }, array_keys(\App\Models\Purchase::$states));
        $statesStringinfied = implode(",", $stateQutoed);

        // custom statment to add enum value to states of the purchases
        DB::statement("ALTER TABLE purchases MODIFY COLUMN state ENUM($statesStringinfied) DEFAULT 'purchased' NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
