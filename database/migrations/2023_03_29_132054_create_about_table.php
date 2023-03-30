<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            // 自動編號
            $table->increments("id");
            // 設定title欄位為文字型態，長度為100, 允許可以不用輸入資料
            $table->string("title", 100)->nullable();
            // 設定content欄位為text型態(可輸入大量資料), 允許可以不用輸入資料
            $table->text("content")->nullable();
            // 設定createDate欄位為日期時間型態，default:預設值
            // CURRENT_TIMESTAMP：寫入資料時當時時間
            //$table->datetime("createDate")->default("CURRENT_TIMESTAMP");
            // 下列方法同上
            $table->datetime("createDate")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about');
    }
}
