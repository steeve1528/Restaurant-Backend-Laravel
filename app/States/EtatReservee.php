<?php

namespace App\States;

use App\Models\Table;
use Exception;

class EtatReservee implements EtatTable
{
    public function nom(): string
    {
        return 'Réservée';
    }

    public function reserver(Table $table): void
    {
        throw new Exception("Cette table est déjà réservée.");
    }

    public function occuper(Table $table): void
    {
        // Le client réservé arrive et s'installe
        $table->changerEtat('occupee');
    }

    public function nettoyer(Table $table): void
    {
        throw new Exception("Impossible de nettoyer une table réservée.");
    }

    public function liberer(Table $table): void
    {
        // Annulation de la réservation
        $table->changerEtat('libre');
    }

    public function mettreHorsService(Table $table): void
    {
        $table->changerEtat('hors_service');
    }

    public function terminer(Table $table): void
    {
        throw new Exception("Les clients ne sont pas encore arrivés.");
    }
}
