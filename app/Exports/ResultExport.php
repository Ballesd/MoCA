<?php

namespace App\Exports;

use App\Models\Moca;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ResultExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    protected $moca_id;
    protected $user_id;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($moca_id, $user_id)
    {
        $this->moca_id = $moca_id;
        $this->user_id = $user_id;
    }

    public function collection()
    {
        $mocas = Moca::with('user')
                ->where('id', $this->moca_id) // Asegúrate de que el campo y el valor condicional estén correctamente definidos
                ->get([
                    'id', 'conceptualAlternative', 'cube', 'clock',
                    'identification', 'identification_answer', 'memory',
                    'attention', 'attention_answer',
                    'language', 'language_answer',
                    'verbal_fluency', 'verbal_fluency_answer',
                    'abstraction', 'abstraction_answer',
                    'deferred_recall', 'deferred_recall_answer',
                    'mis', 'orientation', 'orientation_answer',
                    'total', 'user_id' // Asegúrate de que 'user_id' esté incluido para cargar la relación
                ]);

        return $mocas->map(function ($moca) {
        // Este mapeo transforma cada elemento de la colección en un nuevo arreglo con los campos estructurados
        return [
            'User Lastname' => $moca->user ? $moca->user->lastname : 'N/A',
            'User Name' => $moca->user ? $moca->user->name : 'N/A',
            'Conceptual Alternative' => $moca->conceptualAlternative,
            'Cube' => $moca->cube,
            'Clock' => $moca->clock,
            'Identification' => $moca->identification,
            'Identification Answer' => $moca->identification_answer,
            'Memory' => $moca->memory,
            'Attention' => $moca->attention,
            'Attention Answer' => $moca->attention_answer,
            'Language' => $moca->language,
            'Language Answer' => $moca->language_answer,
            'Verbal Fluency' => $moca->verbal_fluency,
            'Verbal Fluency Answer' => $moca->verbal_fluency_answer,
            'Abstraction' => $moca->abstraction,
            'Abstraction Answer' => $moca->abstraction_answer,
            'Deferred Recall' => $moca->deferred_recall,
            'Deferred Recall Answer' => $moca->deferred_recall_answer,
            'Mis' => $moca->mis,
            'Orientation' => $moca->orientation,
            'Orientation Answer' => $moca->orientation_answer,
            'Total' => $moca->total,
        ];
        });

    }

    public function headings(): array
    {
        return [
            'User Lastname',
            'User Name',
            'Conceptual Alternative',
            'Cube',
            'Clock',
            'Identification',
            'Identification Answer',
            'Memory',
            'Attention',
            'Attention Answer',
            'Language',
            'Language Answer',
            'Verbal Fluency',
            'Verbal Fluency Answer',
            'Abstraction',
            'Abstraction Answer',
            'Deferred Recall',
            'Deferred Recall Answer',
            'Mis',
            'Orientation',
            'Orientation Answer',
            'Total',
        ];
    }
}