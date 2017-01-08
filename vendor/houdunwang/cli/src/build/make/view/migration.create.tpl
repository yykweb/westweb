<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;

class {{className}} extends Migration {
    //执行
	public function up() {
		Schema::create( '{{TABLE}}', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->timestamps();
        });
    }

    //回滚
    public function down() {
        Schema::drop( '{{TABLE}}' );
    }
}