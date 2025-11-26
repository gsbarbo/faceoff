<?php

use App\Models\NewsArticle;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(NewsArticle::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->text('content');
            $table->boolean('is_flagged')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_comments');
    }
};
