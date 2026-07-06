<?php

namespace App\States;

use App\Models\Table;
use Exception;

class EtatANettoyer implements EtatTable
{
    public function nom(): string
    {
        return 'À nettoyer';
    }

    public function reserver(Table $table): void
    {
        throw new Exception("Il faut d'abord nettoyer la table avant de la réserver.");
    }

    public function occuper(Table $table): void
    {
        throw new Exception("Il faut d'abord nettoyer la table avant d'installer des clients.");
    }

    public function nettoyer(Table $table): void
    {
        // Le personnel a fini de nettoyer -> la table redevient libre
        $table->changerEtat('libre');
    }

    public function liberer(Table $table): void
    {
        throw new Exception("Il faut d'abord nettoyer la table.");
    }

    public function mettreHorsService(Table $table): void
    {
        $table->changerEtat('hors_service');
    }

    public function terminer(Table $table): void
    {
        throw new Exception("Les clients sont déjà partis.");
    }
}
