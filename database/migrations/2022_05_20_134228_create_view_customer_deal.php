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
        \Illuminate\Support\Facades\DB::unprepared('
            CREATE VIEW view_customer_deal AS SELECT
            table_customer.id as customer_id, table_customer_deal.id as deal_id, name, type, money, currency, description, date FROM table_customer
            INNER JOIN table_customer_deal ON table_customer_deal.customer_id = table_customer.id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::unprepared('DROP VIEW view_customer_calculation');
    }
};
