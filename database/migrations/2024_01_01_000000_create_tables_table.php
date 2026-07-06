<?php
// Fichier à placer dans : database/migrations/xxxx_xx_xx_create_tables_table.php
// Génère-le avec : php artisan make:migration create_tables_table

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('tables', function (Blueprint $table) {
        $table->id();
        // Clé étrangère vers la table zones (créée juste avant)
        $table->foreignId('zone_id')->constrained('zones')->onDelete('cascade');
        $table->string('numero');       // ex: "T1", "T2"
        $table->integer('capacite');    // nombre de places
        $table->string('forme');        // ex: "rond", "carre" (utilisé par le seeder)
        $table->decimal('position_x', 5, 2); // Position CSS X en %
        $table->decimal('position_y', 5, 2); // Position CSS Y en %
$table->string('etat')->default('libre');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
