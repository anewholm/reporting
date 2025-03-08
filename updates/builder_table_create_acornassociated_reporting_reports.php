<?php namespace Acorn\Reporting\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateAcornReportingReports extends Migration
{
    public function up()
    {
        Schema::create('acorn_reporting_reports', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('settings');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('acorn_reporting_reports');
    }
}
