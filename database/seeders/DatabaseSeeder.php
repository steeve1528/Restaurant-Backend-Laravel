<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // On nettoie les anciennes données pour éviter les doublons si vous relancez le script
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tables')->truncate();
        DB::table('zones')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Insertion des zones principales selon votre plan de salle
        $salleId = DB::table('zones')->insertGetId([
            'nom' => 'Salle Principale',
            'created_at' => now(), 'updated_at' => now()
        ]);
        $terrasseId = DB::table('zones')->insertGetId([
            'nom' => 'Terrasse',
            'created_at' => now(), 'updated_at' => now()
        ]);
        $vipId = DB::table('zones')->insertGetId([
            'nom' => 'Espace VIP',
            'created_at' => now(), 'updated_at' => now()
        ]);

        // 2. Insertion de quelques tables de test avec leur positionnement CSS (x, y en %)
        DB::table('tables')->insert([
            [
                'id' => 1,
                'zone_id' => $terrasseId,
                'numero' => 'T1',
                'capacite' => 2,
                'forme' => 'rond',
                'position_x' => 15.00,
                'position_y' => 15.00,
                'etat' => 'libre'
            ],
            [
                'id' => 2,
                'zone_id' => $terrasseId,
                'numero' => 'T2',
                'capacite' => 6,
                'forme' => 'rond',
                'position_x' => 15.00,
                'position_y' => 40.00,
                'etat' => 'a_nettoyer'
            ],
            [
                'id' => 3,
                'zone_id' => $salleId,
                'numero' => 'S3',
                'capacite' => 6,
                'forme' => 'rond',
                'position_x' => 55.00,
                'position_y' => 20.00,
                'etat' => 'occupee'
            ],
            [
                'id' => 4,
                'zone_id' => $vipId,
                'numero' => 'V1',
                'capacite' => 4,
                'forme' => 'carre',
                'position_x' => 75.00,
                'position_y' => 70.00,
                'etat' => 'reservee'
            ],
        ]);
    }
}
