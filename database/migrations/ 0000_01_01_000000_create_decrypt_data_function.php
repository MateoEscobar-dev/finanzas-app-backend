<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            //DB::statement('SET GLOBAL log_bin_trust_function_creators = 1');
            DB::unprepared("
                CREATE FUNCTION decryptData(dataInfo VARCHAR(500), masterKey VARCHAR(32))
                RETURNS VARCHAR(1000) CHARSET utf8mb4
                BEGIN
                    DECLARE result VARCHAR(1000);
                    SET result = (SELECT (aes_decrypt(from_base64(dataInfo), MD5(masterKey))));
                    RETURN result;
                END;
            ");
        } elseif ($driver === 'pgsql') {
            // Asegurarse de que la extensión pgcrypto está habilitada
            DB::unprepared("CREATE EXTENSION IF NOT EXISTS pgcrypto;");

            DB::unprepared("
                CREATE OR REPLACE FUNCTION decryptData(dataInfo TEXT, masterKey TEXT)
                RETURNS TEXT AS $$
                BEGIN
                    RETURN pgp_sym_decrypt(decode(dataInfo, 'base64'), masterKey);
                END;
                $$ LANGUAGE plpgsql;
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::unprepared("DROP FUNCTION IF EXISTS decryptData;");
        } elseif ($driver === 'pgsql') {
            DB::unprepared("DROP FUNCTION IF EXISTS decryptData;");
        }
    }
};
