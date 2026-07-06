<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Exception;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // Affiche la liste de toutes les tables
    public function index()
    {
        $tables = Table::all();
        return view('tables.index', compact('tables'));
    }

    // Une seule méthode générique pour toutes les actions (reserver, occuper, etc.)
    public function action(Request $request, Table $table, string $action)
    {
        try {
            // On vérifie que l'action existe bien sur le modèle avant de l'appeler
            $actionsAutorisees = ['reserver', 'occuper', 'nettoyer', 'liberer', 'mettreHorsService', 'terminer'];

            if (!in_array($action, $actionsAutorisees)) {
                throw new Exception("Action inconnue.");
            }

            $table->$action(); // appelle par exemple $table->reserver()

            return back()->with('succes', "Nouvel état de la table {$table->numero} : {$table->nomEtat()}");
        } catch (Exception $e) {
            // Si la transition n'est pas autorisée, on affiche le message d'erreur
            return back()->with('erreur', $e->getMessage());
        }
    }
}
