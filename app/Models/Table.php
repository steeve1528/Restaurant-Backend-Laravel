<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\States\EtatTable;
use App\States\EtatLibre;
use App\States\EtatReservee;
use App\States\EtatOccupee;
use App\States\EtatANettoyer;
use App\States\EtatHorsService;

class Table extends Model
{
    protected $fillable = ['numero', 'capacite', 'etat'];

    /**
     * C'est ici la partie "magique" :
     * on regarde la valeur de la colonne "etat" (texte en BDD)
     * et on renvoie l'OBJET d'état correspondant.
     */
    public function getEtatObjet(): EtatTable
    {
        return match ($this->etat) {
            'libre'         => new EtatLibre(),
            'reservee'      => new EtatReservee(),
            'occupee'       => new EtatOccupee(),
            'a_nettoyer'    => new EtatANettoyer(),
            'hors_service'  => new EtatHorsService(),
            default         => new EtatLibre(),
        };
    }

    // Change simplement la valeur en base de données et sauvegarde
    public function changerEtat(string $nouvelEtat): void
    {
        $this->etat = $nouvelEtat;
        $this->save();
    }

    // Ces méthodes délèguent le travail à l'état actuel (c'est le principe du State Pattern)
    public function reserver(): void       { $this->getEtatObjet()->reserver($this); }
    public function occuper(): void        { $this->getEtatObjet()->occuper($this); }
    public function nettoyer(): void       { $this->getEtatObjet()->nettoyer($this); }
    public function liberer(): void        { $this->getEtatObjet()->liberer($this); }
    public function mettreHorsService(): void { $this->getEtatObjet()->mettreHorsService($this); }
    public function terminer(): void       { $this->getEtatObjet()->terminer($this); }

    // Pratique pour l'affichage dans la vue
    public function nomEtat(): string
    {
        return $this->getEtatObjet()->nom();
    }
}
