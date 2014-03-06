<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate', function($table)
        {
            $table->increments('id'); // Primary key 'id', 照片 src will be as the same as this
            $table->integer('regis_type'); // 1:學生會正副會長 2:學生代表 3:系總幹事

            $table->string('name', 10); // 姓名
            $table->boolean('sex'); // 性別，男生為true、女生為false
            $table->integer('depart'); // 系所
            $table->integer('grade'); // 年級
            $table->longText('exp'); // 經歷
            $table->longText('politics'); // 政見
            $table->string('phone', 10); // 電話
            $table->string('email'); // 常用電子信箱
            $table->boolean('agree'); // 個資法同意

            $table->string('code', 10); // 驗證碼可進行資料修改

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
