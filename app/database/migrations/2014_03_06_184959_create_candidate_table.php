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
            $table->integer('regis_type'); // 0:學生會會長 1:學生會副會長 2:學生代表 3:系總幹事

            $table->integer('type_data');
            // 這個欄位的值的意義要看 regis_type:
            //     regis_type = 0 => 空值
            //     regis_type = 1 => 對應會長的 id
            //     regis_type = 2 => 空值
            //     regis_type = 3 => 空值

            $table->string('name', 20); // 姓名
            $table->tinyInteger('sex'); // 性別，男生為1、女生為0
            $table->string('depart',23); // 系級
            $table->string('exp',300); // 經歷
            $table->string('politics',300); // 政見
            $table->string('phone',10); // 電話
            $table->string('email',50); // 常用電子信箱
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
