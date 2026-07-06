<?php

namespace App\States;

use App\Models\Table;
use Exception;

class EtatOccupee implements EtatTable
{
    public function nom(): string
    {
        return 'Occupée';
    }

    public function reserver(Table $table): void
    {
        throw new Exception("Impossible de réserver une table occupée.");
    }

    public function occuper(Table $table): void
    {
        throw new Exception("Cette table est déjà occupée.");
    }

    public function nettoyer(Table $table): void
    {
        throw new Exception("On ne nettoie pas une table pendant que les clients mangent.");
    }

    public function liberer(Table $table): void
    {
        throw new Exception("Les clients partent d'abord, puis la table doit être nettoyée.");
    }

    public function mettreHorsService(Table $table): void
    {
        throw new Exception("Impossible de mettre hors service une table occupée.");
    }

    // Action spéciale : les clients ont fini et sont partis
    public function terminer(Table $table): void
    {
        $table->changerEtat('a_nettoyer');
    }
}
