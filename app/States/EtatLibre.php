<?php

namespace App\States;

use App\Models\Table;
use Exception;

class EtatLibre implements EtatTable
{
    public function nom(): string
    {
        return 'Libre';
    }

    public function reserver(Table $table): void
    {
        // Une table libre PEUT être réservée -> on change l'état
        $table->changerEtat('reservee');
    }

    public function occuper(Table $table): void
    {
        // Une table libre peut aussi être occupée directement
        // (client sans réservation qui s'assoit)
        $table->changerEtat('occupee');
    }

    public function nettoyer(Table $table): void
    {
        // Une table déjà libre n'a pas besoin d'être nettoyée
        throw new Exception("Cette table est déjà libre, inutile de la nettoyer.");
    }

    public function liberer(Table $table): void
    {
        throw new Exception("Cette table est déjà libre.");
    }

    public function mettreHorsService(Table $table): void
    {
        $table->changerEtat('hors_service');
    }

    public function terminer(Table $table): void
    {
        throw new Exception("Il n'y a pas de clients à faire partir, la table est déjà libre.");
    }
}
