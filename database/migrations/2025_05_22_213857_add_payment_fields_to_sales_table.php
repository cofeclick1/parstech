<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentFieldsToSalesTable extends Migration
{
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            // ستون‌های اصلی پرداخت
            $table->string('payment_method')->nullable();
            $table->text('payment_notes')->nullable();
            $table->integer('cash_amount')->nullable();
            $table->timestamp('cash_paid_at')->nullable();
            $table->string('cash_reference')->nullable();
            $table->integer('card_amount')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_bank')->nullable();
            $table->string('card_reference')->nullable();
            $table->timestamp('card_paid_at')->nullable();
            $table->integer('pos_amount')->nullable();
            $table->string('pos_terminal')->nullable();
            $table->string('pos_reference')->nullable();
            $table->timestamp('pos_paid_at')->nullable();
            $table->integer('online_amount')->nullable();
            $table->string('online_transaction_id')->nullable();
            $table->string('online_reference')->nullable();
            $table->timestamp('online_paid_at')->nullable();
            $table->integer('cheque_amount')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('cheque_bank')->nullable();
            $table->date('cheque_due_date')->nullable();
            $table->string('cheque_status')->nullable();
            $table->timestamp('cheque_received_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->integer('remaining_amount')->nullable();
        });
    }

    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_notes',
                'cash_amount',
                'cash_paid_at',
                'cash_reference',
                'card_amount',
                'card_number',
                'card_bank',
                'card_reference',
                'card_paid_at',
                'pos_amount',
                'pos_terminal',
                'pos_reference',
                'pos_paid_at',
                'online_amount',
                'online_transaction_id',
                'online_reference',
                'online_paid_at',
                'cheque_amount',
                'cheque_number',
                'cheque_bank',
                'cheque_due_date',
                'cheque_status',
                'cheque_received_at',
                'paid_at',
                'remaining_amount',
            ]);
        });
    }
}
