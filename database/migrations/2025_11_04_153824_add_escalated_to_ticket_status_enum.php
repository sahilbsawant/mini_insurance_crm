<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    DB::statement("ALTER TABLE tickets MODIFY status ENUM('open','in_progress','closed','escalated') NOT NULL DEFAULT 'open'");
}

public function down()
{
    DB::statement("ALTER TABLE tickets MODIFY status ENUM('open','in_progress','closed') NOT NULL DEFAULT 'open'");
}
};
