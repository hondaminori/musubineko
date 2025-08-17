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
    Schema::create('cat_images', function (Blueprint $table) {

      // 主キー
      $table->id('catimage_id')->comment('猫画像ID');

      // ストレージ情報
      $table->string('catimage_disk', 32)->default('public')->comment('ストレージディスク名');
      $table->string('catimage_path', 500)->comment('保存パス（ディスク基準の相対パス）');

      // 表示制御
      $table->boolean('is_primary')->default(false)->comment('主画像フラグ'); // 一覧でのサムネ・代表画像
      $table->smallInteger('sort_order')->nullable()->comment('並び順（1〜7想定）');

      // 監査情報
      $table->timestamp('created_at')->nullable()->comment('登録日時');
      $table->integer('created_by')->nullable()->comment('登録者');
      $table->timestamp('updated_at')->nullable()->comment('更新日時');
      $table->integer('updated_by')->nullable()->comment('更新者');

      // インデックス
      $table->index('cat_id');                        // IDX: 親猫で検索
      $table->index('is_primary');                    // IDX: 主画像の取得
      $table->unique(['cat_id', 'sort_order']);       // 1匹の中で並び順は一意
      $table->unique('catimage_path');                // 同一ファイルの二重登録防止
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cat_images');
  }
};
