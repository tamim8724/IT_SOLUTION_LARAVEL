<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mongodb') {
            // MongoDB: nothing to change (indexes are made in the create migration)
            return;
        }

        Schema::table('enquiries', function (Blueprint $table) {
            // Set when the visitor confirms the email code (AI chat leads)
            $table->timestamp('verified_at')->nullable()->after('ip');
            $table->index('email');
            $table->index('phone');
        });
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mongodb') {
            return;
        }

        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropIndex(['email']);
            $table->dropIndex(['phone']);
            $table->dropColumn('verified_at');
        });
    }
};
