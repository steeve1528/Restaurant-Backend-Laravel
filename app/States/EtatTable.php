<?php

namespace App\States;

use App\Models\Table;

/**
 * C'est le "contrat" que toutes les classes d'état doivent respecter.
 * Chaque état (Libre, Réservée, Occupée...) va dire :
 * "si on fait cette action, voici ce qui se passe"
 */
interface EtatTable
{
    // Nom lisible de l'état (utile pour l'affichage)
    public function nom(): string;

    // Que se passe-t-il si on essaie de réserver la table ?
    public function reserver(Table $table): void;

    // Que se passe-t-il si on essaie de dire "les clients sont assis" ?
    public function occuper(Table $table): void;

    // Que se passe-t-il si on essaie de nettoyer la table ?
    public function nettoyer(Table $table): void;

    // Que se passe-t-il si on remet la table libre ?
    public function liberer(Table $table): void;

    // Que se passe-t-il si on met la table hors service ?
    public function mettreHorsService(Table $table): void;

    // Que se passe-t-il quand les clients ont fini de manger et partent ?
    public function terminer(Table $table): void;
}
