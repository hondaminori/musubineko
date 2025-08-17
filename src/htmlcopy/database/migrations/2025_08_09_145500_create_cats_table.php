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
    Schema::create('cats', function (Blueprint $table) {
      // 主キー
      $table->id('cat_id'); // 猫ID

      // 基本情報
      $table->string('cat_name', 50)->nullable()->comment('名前');
      $table->smallInteger('breed')->nullable()->comment('種類コード');
      $table->smallInteger('gender')->nullable()->comment('性別コード');
      $table->integer('cat_age')->nullable()->comment('年齢');

      // 健康状態・募集条件
      $table->boolean('neutered')->default(false)->comment('避妊・去勢済みフラグ');
      $table->boolean('vaccinated')->default(false)->comment('ワクチン接種済みフラグ');
      $table->boolean('fivtest_result')->default(false)->comment('猫エイズ検査結果');
      $table->boolean('felvtest_result')->default(false)->comment('猫白血病検査結果');
      $table->string('other_disabilities', 200)->nullable()->comment('その他障害');
      $table->boolean('accept_singleapplicant')->default(false)->comment('単身者応募可');
      $table->boolean('accept_elderlyapplicant')->default(false)->comment('高齢者応募可');

      // 保護経緯・性格等
      $table->string('found_info', 200)->nullable()->comment('保護までの経緯・発見情報');
      $table->string('rescue_info', 200)->nullable()->comment('保護経緯');
      $table->string('personality', 200)->nullable()->comment('性格・特徴');
      $table->string('handover_method', 200)->nullable()->comment('引き渡し方法');
      $table->string('health_condition', 200)->nullable()->comment('健康状態');

      // 備考
      $table->text('cat_public_note')->nullable()->comment('備考（公開）');
      $table->text('cat_private_note')->nullable()->comment('備考（非公開）');

      // 公開期間
      $table->date('published_from')->nullable()->comment('公開開始日');
      $table->date('published_until')->nullable()->comment('公開終了日');

      // ステータス
      $table->smallInteger('cat_status')->nullable()->comment('ステータスコード');

      // 登録・更新情報
      $table->timestamp('created_at')->nullable()->comment('登録日時');
      $table->integer('created_by')->nullable()->comment('登録者');
      $table->timestamp('updated_at')->nullable()->comment('更新日時');
      $table->integer('updated_by')->nullable()->comment('更新者');

      // インデックス（検索条件に使う項目）
      $table->index('cat_name');    // 名前
      $table->index('breed');       // 種類
      $table->index('gender');      // 性別
      $table->index('cat_age');     // 年齢
      $table->index('created_at');  // 登録日時
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cats');
  }
};
