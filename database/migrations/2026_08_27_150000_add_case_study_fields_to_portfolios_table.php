<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->text('challenge')->nullable()->after('description');
            $table->text('solution')->nullable()->after('challenge');
            $table->text('impact')->nullable()->after('solution');
            $table->string('github_url')->nullable()->after('website_url');
            $table->string('demo_url')->nullable()->after('github_url');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['challenge', 'solution', 'impact', 'github_url', 'demo_url']);
        });
    }
};
