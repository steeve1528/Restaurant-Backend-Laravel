<?php

namespace App\States;

use App\Models\Table;
use Exception;

class EtatHorsService implements EtatTable
{
    public function nom(): string
    {
        return 'Hors service';
    }

    public function reserver(Table $table): void
    {
        throw new Exception("Cette table est hors service, impossible de la réserver.");
    }

    public function occuper(Table $table): void
    {
        throw new Exception("Cette table est hors service, impossible d'installer des clients.");
    }

    public function nettoyer(Table $table): void
    {
        throw new Exception("Cette table est hors service, le nettoyage ne suffit pas.");
    }

    public function liberer(Table $table): void
    {
        // La table est réparée -> elle redevient libre
        $table->changerEtat('libre');
    }

    public function mettreHorsService(Table $table): void
    {
        throw new Exception("Cette table est déjà hors service.");
    }

    public function terminer(Table $table): void
    {
        throw new Exception("Cette table est hors service.");
    }
}
