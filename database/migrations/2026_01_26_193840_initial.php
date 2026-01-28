<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Company
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->max(100);
            $table->string('email')->max(120)->unique();
            $table->string('address')->max(250);
            $table->string('state')->max(100);
            $table->string('country')->max(100);
            $table->string('zip_code')->max(100);
            $table->string('phone')->max(14);
            $table->timestamps();
        });

        //Client
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->max(100);
            $table->string('last_name')->max(100);
            $table->string('email')->max(120)->unique();
            $table->string('address')->max(250);
            $table->string('state')->max(100);
            $table->string('country')->max(100);
            $table->string('zip_code')->max(100);
            $table->string('phone')->max(14);
            $table->timestamps();
        });

        //Invoice
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->decimal('subtotal');
            $table->decimal('discount');
            $table->decimal('total');
            $table->timestamp('due_date');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->timestamps();
        });

        //Item
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('description')->max(100);
            $table->integer('type')->value('product');
        });

        //InvoiceItem
         Schema::create('invoice_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('item_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('item_id')->references('id')->on('items');
            $table->integer('quantity');
            $table->decimal('unit_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Invoices
        Schema::table('invoices', function (Blueprint $table) {
           $table->dropForeign('invoice_item_invoice_id_foreign');
           $table->dropForeign('invoice_item_item_id_foreign');
        });

        //InvoiceItem
         Schema::create('invoice_item', function (Blueprint $table) {
            $table->dropForeign('invoice_item_invoice_id_foreign');
            $table->dropForeign('invoice_item_item_id_foreign');
         });
    }
};
