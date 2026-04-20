<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
                CREATE FUNCTION encryptData(dataInfo VARCHAR(500), masterKey VARCHAR(32))
                RETURNS VARCHAR(1000) CHARSET utf8mb4
                BEGIN
                    DECLARE result VARCHAR(1000);
                    SET result = (SELECT to_base64(aes_encrypt(dataInfo, MD5(masterKey))));
                    RETURN result;
                END;
            ");
        } elseif ($driver === 'pgsql') {
            // Asegurar que la extensión pgcrypto está habilitada
            DB::unprepared("CREATE EXTENSION IF NOT EXISTS pgcrypto;");

            DB::unprepared("
                CREATE OR REPLACE FUNCTION encryptData(dataInfo TEXT, masterKey TEXT)
                RETURNS TEXT AS $$
                BEGIN
                    RETURN encode(pgp_sym_encrypt(dataInfo, masterKey), 'base64');
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
            DB::unprepared("DROP FUNCTION IF EXISTS encryptData;");
        } elseif ($driver === 'pgsql') {
            DB::unprepared("DROP FUNCTION IF EXISTS encryptData;");
        }
    }
};
