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
    Schema::create('cat_breeds', function (Blueprint $table) {
      // 主キー
      $table->id('breed_id')->comment('猫種類ID');

      // 基本情報
      $table->smallInteger('breed_status')->comment('猫種類区分');
      $table->string('breed_name',40)->comment('猫種類名');
      $table->boolean('is_public')->default(true)->comment('表示');

      // 監査情報
      $table->timestamp('created_at')->nullable()->comment('登録日時');
      $table->integer('created_by')->nullable()->comment('登録者');
      $table->timestamp('updated_at')->nullable()->comment('更新日時');
      $table->integer('updated_by')->nullable()->comment('更新者');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cat_breeds');
  }
};
