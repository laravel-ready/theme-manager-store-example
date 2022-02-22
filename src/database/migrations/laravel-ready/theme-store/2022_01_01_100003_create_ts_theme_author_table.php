<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsThemeAuthorTable extends Migration
{
    public function __construct()
    {
        $this->prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$this->prefix}_themes_authors";
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->foreignId('theme_id')
                ->constrained("{$this->prefix}_themes")
                ->onDelete('cascade');

            $table->foreignId('author_id')
                ->constrained("{$this->prefix}_authors")
                ->onDelete('cascade');

            $table->unique(['theme_id', 'author_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->dropConstrainedForeignId('theme_id');
            $table->dropConstrainedForeignId('author_id');

            $table->dropIfExists();
        });
    }
}
