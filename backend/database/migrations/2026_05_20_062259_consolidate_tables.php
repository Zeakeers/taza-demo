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
        // 1. Create `posts` table
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'artikel' or 'berita'
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->nullable();
            $table->string('thumbnail')->nullable();
            $table->longText('konten')->nullable();
            $table->boolean('show_on_home')->default(false);
            $table->boolean('is_published')->default(true);
            $table->boolean('is_editor_choice')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->string('tags')->nullable();
            $table->timestamps();
        });

        // Copy data if table exists
        if (Schema::hasTable('artikels')) {
            $artikels = DB::table('artikels')->get();
            foreach ($artikels as $a) {
                $data = (array)$a;
                unset($data['id']);
                DB::table('posts')->insert(array_merge($data, ['type' => 'artikel', 'is_popular' => false]));
            }
            Schema::dropIfExists('artikels');
        }

        if (Schema::hasTable('beritas')) {
            $beritas = DB::table('beritas')->get();
            foreach ($beritas as $b) {
                $data = (array)$b;
                unset($data['id']);
                DB::table('posts')->insert(array_merge($data, ['type' => 'berita', 'is_editor_choice' => false]));
            }
            Schema::dropIfExists('beritas');
        }

        // 2. Create `tata_kelolas` table
        Schema::create('tata_kelolas', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'annual', 'financial', 'audit_iso', 'legal_formal'
            $table->string('year')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('link_text')->nullable();
            $table->longText('elements')->nullable();
            $table->timestamps();
        });

        // Copy data for tata kelola
        if (Schema::hasTable('annual_reports')) {
            $annuals = DB::table('annual_reports')->get();
            foreach ($annuals as $a) {
                $data = (array)$a;
                unset($data['id']);
                DB::table('tata_kelolas')->insert(array_merge($data, ['type' => 'annual']));
            }
            Schema::dropIfExists('annual_reports');
        }

        if (Schema::hasTable('financial_reports')) {
            $financials = DB::table('financial_reports')->get();
            foreach ($financials as $f) {
                $data = (array)$f;
                unset($data['id']);
                DB::table('tata_kelolas')->insert(array_merge($data, ['type' => 'financial']));
            }
            Schema::dropIfExists('financial_reports');
        }

        if (Schema::hasTable('audit_isos')) {
            $audits = DB::table('audit_isos')->get();
            foreach ($audits as $a) {
                $data = (array)$a;
                unset($data['id']);
                DB::table('tata_kelolas')->insert(array_merge($data, ['type' => 'audit_iso']));
            }
            Schema::dropIfExists('audit_isos');
        }

        if (Schema::hasTable('legal_formals')) {
            $legals = DB::table('legal_formals')->get();
            foreach ($legals as $l) {
                $data = (array)$l;
                unset($data['id']);
                if (is_string($data['elements'])) {
                    $elements = $data['elements'];
                } else {
                    $elements = json_encode($data['elements']);
                }
                DB::table('tata_kelolas')->insert(array_merge($data, ['type' => 'legal_formal', 'elements' => $elements]));
            }
            Schema::dropIfExists('legal_formals');
        }
    }

    public function down(): void
    {
        // Revert is complex, just drop new tables.
        Schema::dropIfExists('posts');
        Schema::dropIfExists('tata_kelolas');
    }
};
