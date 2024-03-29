<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('voucher_block_id');
            $table->string('code', 16)->unique();
            $table->dateTime('redeemed_at')->nullable();
            $table->unsignedBigInteger('redeemed_by_user_id')->nullable();
            $table->timestamps();

            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')->cascadeOnDelete();

            $table->foreign('voucher_block_id')
                ->references('id')
                ->on('voucher_blocks')->cascadeOnDelete();

            $table->foreign('redeemed_by_user_id')
                ->references('id')
                ->on('users');

        });

        DB::unprepared('
            CREATE PROCEDURE generate_vouchers(IN campaignId INT,IN voucher_blockId INT, IN numberOfVouchers INT)
            BEGIN
                DECLARE chars VARCHAR(62);
                DECLARE code VARCHAR(16);
                SET chars = \'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789\';

                WHILE numberOfVouchers > 0 DO

                        SET code = \'\';

                        WHILE CHAR_LENGTH(code) < 16 DO
                            SET code = CONCAT(code, SUBSTRING(chars, FLOOR(RAND() * 62) + 1, 1));
                        END WHILE;

                    INSERT INTO vouchers (campaign_id, voucher_block_id, code) VALUES (campaignID, voucher_blockId, code);

                    SET numberOfVouchers = numberOfVouchers - 1;
                END WHILE;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
