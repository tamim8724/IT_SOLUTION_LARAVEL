<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mongodb') {
            // MongoDB: just the collection and its indexes
            Schema::create('enquiries', function ($c) {
                $c->index('status');
                $c->index('created_at');
                $c->index('email');
                $c->index('phone');
            });
            return;
        }

        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 150);
            $table->string('phone', 30)->nullable();
            $table->string('service', 100)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('budget', 40)->nullable();
            $table->text('message');
            $table->string('status', 20)->default('new')->index(); // new, replied, won, lost
            $table->text('notes')->nullable();
            $table->string('source_page', 255)->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
