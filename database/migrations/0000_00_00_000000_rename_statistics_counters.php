counters.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RenameStatisticsCounters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Usar sintaxis compatible con MariaDB
        if (Schema::hasColumn('websockets_statistics_entries', 'peak_connection_count')) {
            DB::statement('ALTER TABLE `websockets_statistics_entries` CHANGE `peak_connection_count` `peak_connections_count` INT UNSIGNED NOT NULL');
        }
        
        if (Schema::hasColumn('websockets_statistics_entries', 'websocket_message_count')) {
            DB::statement('ALTER TABLE `websockets_statistics_entries` CHANGE `websocket_message_count` `websocket_messages_count` INT UNSIGNED NOT NULL');
        }
        
        if (Schema::hasColumn('websockets_statistics_entries', 'api_message_count')) {
            DB::statement('ALTER TABLE `websockets_statistics_entries` CHANGE `api_message_count` `api_messages_count` INT UNSIGNED NOT NULL');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Usar sintaxis compatible con MariaDB
        if (Schema::hasColumn('websockets_statistics_entries', 'peak_connections_count')) {
            DB::statement('ALTER TABLE `websockets_statistics_entries` CHANGE `peak_connections_count` `peak_connection_count` INT UNSIGNED NOT NULL');
        }
        
        if (Schema::hasColumn('websockets_statistics_entries', 'websocket_messages_count')) {
            DB::statement('ALTER TABLE `websockets_statistics_entries` CHANGE `websocket_messages_count` `websocket_message_count` INT UNSIGNED NOT NULL');
        }
        
        if (Schema::hasColumn('websockets_statistics_entries', 'api_messages_count')) {
            DB::statement('ALTER TABLE `websockets_statistics_entries` CHANGE `api_messages_count` `api_message_count` INT UNSIGNED NOT NULL');
        }
    }
}