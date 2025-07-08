<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'edad',
        'genero',
        'etnicidad',
        'nivel_educativo',
        'imc',
        'fumar',
        'consumo_alcohol',
        'actividad_fisica',
        'calidad_dieta',
        'calidad_sueno',
        'antecedentes_familiares_parkinson',
        'traumatismo_craneoencefalico',
        'hipertension',
        'diabetes',
        'depresion',
        'accidente_cerebrovascular',
        'presion_sistolica',
        'presion_diastolica',
        'colesterol_total',
        'colesterol_ldl',
        'colesterol_hdl',
        'trigliceridos',
        'moca',
        'temblor',
        'rigidez',
        'bradicinesia',
        'inestabilidad_postural',
        'problemas_habla',
        'trastornos_sueno',
        'estrenimiento',
        // Diagnosis Information
        'diagnostico', 
        
        // Confidential Information
        'medico_encargado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
