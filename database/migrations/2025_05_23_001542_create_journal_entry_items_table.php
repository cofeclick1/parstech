<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalEntryItemsTable extends Migration
{
    public function up()
    {
        Schema::create('journal_entry_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('journal_entry_id');
            $table->unsignedBigInteger('account_id')->comment('حساب معین');
            $table->decimal('debit', 20, 2)->default(0)->comment('مبلغ بدهکار');
            $table->decimal('credit', 20, 2)->default(0)->comment('مبلغ بستانکار');
            $table->string('description')->nullable()->comment('شرح آیتم سند');
            $table->string('reference')->nullable()->comment('شماره یا مرجع تراکنش');
            $table->timestamps();

            $table->foreign('journal_entry_id')->references('id')->on('journal_entries')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('journal_entry_items');
    }
}
