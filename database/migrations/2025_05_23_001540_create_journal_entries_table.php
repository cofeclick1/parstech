<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->string('entry_number')->unique()->comment('شماره سند روزنامه');
            $table->date('entry_date')->comment('تاریخ سند');
            $table->string('description')->nullable()->comment('شرح کلی سند');
            $table->unsignedBigInteger('user_id')->nullable()->comment('ایجادکننده');
            $table->unsignedBigInteger('related_invoice_id')->nullable()->comment('ارتباط با فاکتور فروش/خرید');
            $table->string('document_type')->nullable()->comment('نوع سند (فروش، خرید، هزینه، درآمد و...)');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('related_invoice_id')->references('id')->on('invoices')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journal_entries');
    }
}
