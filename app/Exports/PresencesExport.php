<?php

namespace App\Exports;

namespace App\Exports;

use App\Models\Presence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PresencesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Presence::with('user')->get()->map(function ($presence) {
            return [
                'Nom' => $presence->user->name,
                'Date' => $presence->date,
                'Heure arrivée' => $presence->heure_arrivee,
                'Heure départ' => $presence->heure_depart,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nom', 'Date', 'Heure arrivée', 'Heure départ'];
    }
}

