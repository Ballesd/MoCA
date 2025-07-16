<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Moca;
use App\Models\Clinic_history;
use App\Models\Cardiovascular_events;
use App\Models\Pathological_record;
use App\Models\Paraclinical;
use App\Models\Relatives;
use App\Models\Work_activity;
use App\Models\Scholarship;
use App\Models\Traumatic;
use App\Models\Toxic;
use App\Models\Record;
use App\Models\Surgical;
use App\Models\Medicine;
use App\Models\Prediction;


class MedicController extends Controller
{
    public function index()
    {
        return Inertia::render('Medic/Index');

    }

    public function history()
    {
        return Inertia::render('Medic/GetCliniciHistory');

    }

    public function show()
    {
        return Inertia::render('Medic/MocaResults');

    }

    public function prediction($id = null)
    {
        // Get existing prediction if it exists
        $existingPrediction = null;
        if ($id) {
            $existingPrediction = Prediction::where('user_id', $id)->latest()->first();
        }

        return Inertia::render('Medic/Prediction', [
            'id' => $id,
            'existingPrediction' => $existingPrediction
        ]);
    }

    public function getMoca(Request $request)
    {

        $user = User::where('identification', $request->identification)->first();
        if (!$user) {
            return 'No se encontro el usuario';
        } else {
            $moca = Moca::where('user_id', $user->id)->first();
            if (!$moca) {
                return 'El usuario no ha realizado el examen';
            }
        }

        return compact('user', 'moca');
    }

    public function editMoca(Request $request)
    {

        $moca = Moca::where('user_id', $request->user_id)->first();
        $moca->ConceptualAlternative = $request->ConceptualAlternative;
        $moca->cube = $request->cube;
        $moca->clock = $request->clock;
        $moca->identification = $request->identification;
        $moca->language = $request->language;
        $moca->abstraction = $request->abstraction;
        $moca->attention = $request->attention;
        $moca->verbal_fluency = $request->verbal_fluency;
        $moca->deferred_recall = $request->deferred_recall;
        $moca->orientation = $request->orientation;

        $moca->total = $moca->cube + $moca->clock + $moca->identification + $moca->language + $moca->abstraction + $moca->attention + $moca->verbal_fluency + $moca->deferred_recall + $moca->orientation + $moca->ConceptualAlternative;

        $moca->save();
        return $moca;
    }

    public function clinicHistory()
    {
        return Inertia::render('Medic/ClinicHistory');
    }

    public function getUser(Request $request)
    {
        $user = User::where('identification', $request->identification)->first();
        if (!$user) {
            return 'No se encontro el usuario';
        }
        return $user;
    }

    public function makeHistiryCLinic(Request $request)
    {

        $cardiovascular_events = new Cardiovascular_events();
        $cardiovascular_events->ischemic_cardiac = $request->cardiovascular_events['ischemic_cardiac'];
        $cardiovascular_events->hemorrhagic_cardiac = $request->cardiovascular_events['hemorrhagic_cardiac'];
        $cardiovascular_events->time_cardiac = $request->cardiovascular_events['time_cardiac'];
        $cardiovascular_events->ischemic_cerebral = $request->cardiovascular_events['ischemic_cerebral'];
        $cardiovascular_events->hemorrhagic_cerebral = $request->cardiovascular_events['hemorrhagic_cerebral'];
        $cardiovascular_events->time_cerebral = $request->cardiovascular_events['time_cerebral'];
        $cardiovascular_events->ischemic_others = $request->cardiovascular_events['ischemic_others'];
        $cardiovascular_events->hemorrhagic_others = $request->cardiovascular_events['hemorrhagic_others'];
        $cardiovascular_events->time_others = $request->cardiovascular_events['time_others'];
        $cardiovascular_events->save();

        $pathological_records = new Pathological_record();
        $pathological_records->neoplasia = $request->pathological_records['neoplasia'];
        $pathological_records->neoplasia_type = $request->pathological_records['neoplasia_type'];
        $pathological_records->evolution_time = $request->pathological_records['evolution_time'];
        $pathological_records->arterial_hypertension = $request->pathological_records['arterial_hypertension'];
        $pathological_records->arterial_hypertension_type = $request->pathological_records['arterial_hypertension_type'];
        $pathological_records->arterial_hypertension_time = $request->pathological_records['arterial_hypertension_time'];
        $pathological_records->hypothyroidism = $request->pathological_records['hypothyroidism'];
        $pathological_records->hypothyroidism_type = $request->pathological_records['hypothyroidism_type'];
        $pathological_records->hypothyroidism_time = $request->pathological_records['hypothyroidism_time'];
        $pathological_records->hiperlipidemia = $request->pathological_records['hiperlipidemia'];
        $pathological_records->hiperlipidemia_type = $request->pathological_records['hiperlipidemia_type'];
        $pathological_records->hiperlipidemia_time = $request->pathological_records['hiperlipidemia_time'];
        $pathological_records->neurological = $request->pathological_records['neurological'];
        $pathological_records->neurological_type = $request->pathological_records['neurological_type'];
        $pathological_records->neurological_time = $request->pathological_records['neurological_time'];
        $pathological_records->psychiatric = $request->pathological_records['psychiatric'];
        $pathological_records->psychiatric_type = $request->pathological_records['psychiatric_type'];
        $pathological_records->psychiatric_time = $request->pathological_records['psychiatric_time'];
        $pathological_records->chronic_infection = $request->pathological_records['chronic_infection'];
        $pathological_records->chronic_infection_type = $request->pathological_records['chronic_infection_type'];
        $pathological_records->chronic_infection_time = $request->pathological_records['chronic_infection_time'];
        $pathological_records->others = $request->pathological_records['others'];
        $pathological_records->others_type = $request->pathological_records['others_type'];
        $pathological_records->others_time = $request->pathological_records['others_time'];
        $pathological_records->save();

        $paraclinicals = new Paraclinical();
        $paraclinicals->nuclear_magnetic_resonance_concept = $request->paraclinicals['nuclear_magnetic_resonance_concept'];
        $paraclinicals->nuclear_magnetic_resonance_date = $request->paraclinicals['nuclear_magnetic_resonance_date'];
        $paraclinicals->tac_concept = $request->paraclinicals['tac_concept'];
        $paraclinicals->tac_date = $request->paraclinicals['tac_date'];
        $paraclinicals->save();

        $relatives = new Relatives();
        $relatives->parents = $request->relatives['parents'];
        $relatives->specify_parents = $request->relatives['specify_parents'];
        $relatives->consanguinity_parents = $request->relatives['consanguinity_parents'];
        $relatives->diabetes = $request->relatives['diabetes'];
        $relatives->specify_diabetes = $request->relatives['specify_diabetes'];
        $relatives->consanguinity_diabetes = $request->relatives['consanguinity_diabetes'];
        $relatives->cardiovascular = $request->relatives['cardiovascular'];
        $relatives->specify_cardiovascular = $request->relatives['specify_cardiovascular'];
        $relatives->consanguinity_cardiovascular = $request->relatives['consanguinity_cardiovascular'];
        $relatives->hypertension = $request->relatives['hypertension'];
        $relatives->specify_hypertension = $request->relatives['specify_hypertension'];
        $relatives->consanguinity_hypertension = $request->relatives['consanguinity_hypertension'];
        $relatives->neoplasms = $request->relatives['neoplasms'];
        $relatives->specify_neoplasms = $request->relatives['specify_neoplasms'];
        $relatives->consanguinity_neoplasms = $request->relatives['consanguinity_neoplasms'];
        $relatives->psychiatric = $request->relatives['psychiatric'];
        $relatives->specify_psychiatric = $request->relatives['specify_psychiatric'];
        $relatives->consanguinity_psychiatric = $request->relatives['consanguinity_psychiatric'];
        $relatives->neurological = $request->relatives['neurological'];
        $relatives->specify_neurological = $request->relatives['specify_neurological'];
        $relatives->consanguinity_neurological = $request->relatives['consanguinity_neurological'];
        $relatives->down_syndrome = $request->relatives['down_syndrome'];
        $relatives->specify_down_syndrome = $request->relatives['specify_down_syndrome'];
        $relatives->consanguinity_down_syndrome = $request->relatives['consanguinity_down_syndrome'];
        $relatives->intellectual_disability = $request->relatives['intellectual_disability'];
        $relatives->specify_intellectual_disability = $request->relatives['specify_intellectual_disability'];
        $relatives->consanguinity_intellectual_disability = $request->relatives['consanguinity_intellectual_disability'];
        $relatives->dementia = $request->relatives['dementia'];
        $relatives->specify_dementia = $request->relatives['specify_dementia'];
        $relatives->consanguinity_dementia = $request->relatives['consanguinity_dementia'];
        $relatives->others = $request->relatives['others'];
        $relatives->specify_others = $request->relatives['specify_others'];
        $relatives->consanguinity_others = $request->relatives['consanguinity_others'];

        $relatives->save();

        $work_activities = new Work_activity();
        $work_activities->activity = $request->work_activities['activity'];
        $work_activities->place = $request->work_activities['place'];
        $work_activities->position = $request->work_activities['position'];
        $work_activities->actual_situation = $request->work_activities['actual_situation'];
        $work_activities->save();

        $scholarships = new Scholarship();
        $scholarships->primary = $request->scholarships['primary'];
        $scholarships->secondary = $request->scholarships['secondary'];
        $scholarships->technical_superior = $request->scholarships['technical_superior'];
        $scholarships->profesional = $request->scholarships['profesional'];
        $scholarships->postgraduate = $request->scholarships['postgraduate'];
        $scholarships->work_activity_id = $work_activities->id;
        $scholarships->save();

        $traumatics = new Traumatic();
        $traumatics->specific_craniocerebral = $request->traumatics['specific_craniocerebral'];
        $traumatics->elapsed_time = $request->traumatics['elapsed_time'];
        $traumatics->other_traumatic = $request->traumatics['other_traumatic'];
        $traumatics->other_traumatic_time = $request->traumatics['other_traumatic_time'];
        $traumatics->save();

        $toxics = new Toxic();
        $toxics->active_tobacco = $request->toxics['active_tobacco'];
        $toxics->previus_active_tobacco = $request->toxics['previus_active_tobacco'];
        $toxics->age_tobacco_exposition = $request->toxics['age_tobacco_exposition'];
        $toxics->packages_per_year = $request->toxics['packages_per_year'];
        $toxics->pasive_tobacco = $request->toxics['pasive_tobacco'];
        $toxics->previus_pasive_tobacco = $request->toxics['previus_pasive_tobacco'];
        $toxics->age_pasive_tobacco_exposition = $request->toxics['age_pasive_tobacco_exposition'];
        $toxics->packages_per_year_pasive = $request->toxics['packages_per_year_pasive'];
        $toxics->wood_smoke = $request->toxics['wood_smoke'];
        $toxics->previus_wood_smoke = $request->toxics['previus_wood_smoke'];
        $toxics->age_wood_smoke_exposition = $request->toxics['age_wood_smoke_exposition'];
        $toxics->alcohol = $request->toxics['alcohol'];
        $toxics->previus_alcohol = $request->toxics['previus_alcohol'];
        $toxics->age_alcohol_exposition = $request->toxics['age_alcohol_exposition'];
        $toxics->frecuency_alcohol = $request->toxics['frecuency_alcohol'];
        $toxics->drugs = $request->toxics['drugs'];
        $toxics->previus_drugs = $request->toxics['previus_drugs'];
        $toxics->age_drugs_exposition = $request->toxics['age_drugs_exposition'];
        $toxics->frecuency_drugs = $request->toxics['frecuency_drugs'];
        $toxics->save();

        $record = new Record();
        $record->pathological_record_id = $pathological_records->id;
        $record->cardiovascular_event_id = $cardiovascular_events->id;
        $record->traumatic_id = $traumatics->id;
        $record->toxic_id = $toxics->id;
        $record->paraclinical_id = $paraclinicals->id;
        $record->relative_id = $relatives->id;
        $record->save();

        $surgicals = new Surgical();
        $surgicals->type_surgery = $request->surgicals['type_surgery'];
        $surgicals->elapsed_time = $request->surgicals['elapsed_time'];
        $surgicals->record_id = $record->id;
        $surgicals->save();

        $clinic_history = new Clinic_history();
        $clinic_history->clinic = $request->clinic_histories['clinic'];
        $clinic_history->other = $request->clinic_histories['other'];
        $clinic_history->genetic_institute = $request->clinic_histories['genetic_institute'];
        $clinic_history->pk = $request->clinic_histories['pk'];
        $clinic_history->alz = $request->clinic_histories['alz'];
        $clinic_history->control = $request->clinic_histories['control'];
        $clinic_history->blood_sample = $request->clinic_histories['blood_sample'];
        $clinic_history->dentistry_sample = $request->clinic_histories['dentistry_sample'];
        $clinic_history->city = $request->clinic_histories['city'];
        $clinic_history->date = $request->clinic_histories['date'];
        $clinic_history->scholarship_id = $scholarships->id;
        $clinic_history->attendant_name = $request->clinic_histories['attendant_name'];
        $clinic_history->relationship = $request->clinic_histories['relationship'];
        $clinic_history->attendant_phone = $request->clinic_histories['attendant_phone'];
        $clinic_history->reason = $request->clinic_histories['reason'];
        $clinic_history->current_illness = $request->clinic_histories['current_illness'];
        $clinic_history->record_id = $record->id;
        $clinic_history->other_information = $request->clinic_histories['other_information'];
        $clinic_history->user_id = $request->user_id;
        $clinic_history->save();
        ;

        $medicines = new Medicine();
        $medicines->Aluminum = $request->medicines['aluminum'];
        $medicines->others = $request->medicines['others'];

        $medicines->clinic_history_id = $clinic_history->id;
        $medicines->save();

        return 'Se guardo con éxito';
    }

    public function getHistoryClinic(Request $request)
    {

        $user = $request->user_id;

        $clinic_history = Clinic_history::where('user_id', $user)->first();
        $medicines = Medicine::where('clinic_history_id', $clinic_history->id)->first();
        $scholarships = Scholarship::where('id', $clinic_history->scholarship_id)->first();
        $work_activities = Work_activity::where('id', $scholarships->work_activity_id)->first();
        $record = Record::where('id', $clinic_history->record_id)->first();
        $pathological_records = Pathological_record::where('id', $record->pathological_record_id)->first();
        $cardiovascular_events = Cardiovascular_events::where('id', $record->cardiovascular_event_id)->first();
        $paraclinicals = Paraclinical::where('id', $record->paraclinical_id)->first();
        $traumatics = Traumatic::where('id', $record->traumatic_id)->first();
        $toxics = Toxic::where('id', $record->toxic_id)->first();
        $relatives = Relatives::where('id', $record->relative_id)->first();
        $surgicals = Surgical::where('record_id', $record->id)->first();
        return compact('clinic_history', 'scholarships', 'medicines', 'work_activities', 'record', 'pathological_records', 'cardiovascular_events', 'paraclinicals', 'traumatics', 'toxics', 'relatives', 'surgicals');

    }

    public function storePrediction(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            // User Information
            'user_id' => 'required|integer|exists:users,id',
            
            // Demographics
            'edad' => 'required|integer|min:50|max:90',
            'genero' => 'required|integer|in:0,1',
            'etnicidad' => 'required|integer|in:0,1,2,3',
            'nivel_educativo' => 'required|integer|in:0,1,2,3',
            
            // Lifestyle Factors
            'imc' => 'required|numeric|min:15.0|max:40.0',
            'fumar' => 'required|integer|in:0,1',
            'consumo_alcohol' => 'required|integer|min:0|max:20',
            'actividad_fisica' => 'required|integer|min:0|max:10',
            'calidad_dieta' => 'required|integer|min:4|max:10',
            'calidad_sueno' => 'required|integer|min:4|max:10',
            
            // Medical History
            'antecedentes_familiares_parkinson' => 'required|integer|in:0,1',
            'traumatismo_craneoencefalico' => 'required|integer|in:0,1',
            'hipertension' => 'required|integer|in:0,1',
            'diabetes' => 'required|integer|in:0,1',
            'depresion' => 'required|integer|in:0,1',
            'accidente_cerebrovascular' => 'required|integer|in:0,1',
            
            // Clinical Measurements
            'presion_sistolica' => 'required|integer|min:90|max:180',
            'presion_diastolica' => 'required|integer|min:60|max:120',
            'colesterol_total' => 'required|integer|min:150|max:300',
            'colesterol_ldl' => 'required|integer|min:50|max:200',
            'colesterol_hdl' => 'required|integer|min:20|max:100',
            'trigliceridos' => 'required|integer|min:50|max:400',
            
            // Cognitive Assessment
            'moca' => 'required|integer|min:0|max:30',
            
            // Symptoms
            'temblor' => 'required|integer|in:0,1',
            'rigidez' => 'required|integer|in:0,1',
            'bradicinesia' => 'required|integer|in:0,1',
            'inestabilidad_postural' => 'required|integer|in:0,1',
            'problemas_habla' => 'required|integer|in:0,1',
            'trastornos_sueno' => 'required|integer|in:0,1',
            'estrenimiento' => 'required|integer|in:0,1',
            
            // Diagnosis and Doctor
            'diagnostico' => 'nullable|integer|in:0,1',
            'medico_encargado' => 'required|string|max:255',
        ], [
            // Custom error messages in Spanish
            'user_id.required' => 'El ID del usuario es requerido.',
            'user_id.exists' => 'El usuario especificado no existe.',
            
            'edad.required' => 'La edad es requerida.',
            'edad.min' => 'La edad debe ser mínimo 50 años.',
            'edad.max' => 'La edad debe ser máximo 90 años.',
            
            'genero.required' => 'El género es requerido.',
            'genero.in' => 'El género debe ser Masculino (0) o Femenino (1).',
            
            'etnicidad.required' => 'La etnicidad es requerida.',
            'etnicidad.in' => 'La etnicidad debe ser Caucásico (0), Afroamericano (1), Asiático (2) u Otro (3).',
            
            'nivel_educativo.required' => 'El nivel educativo es requerido.',
            'nivel_educativo.in' => 'El nivel educativo debe ser Ninguno (0), Secundaria (1), Licenciatura (2) o Superior (3).',
            
            'imc.required' => 'El IMC es requerido.',
            'imc.min' => 'El IMC debe ser mínimo 15.0.',
            'imc.max' => 'El IMC debe ser máximo 40.0.',
            
            'consumo_alcohol.min' => 'El consumo de alcohol debe ser mínimo 0 unidades/semana.',
            'consumo_alcohol.max' => 'El consumo de alcohol debe ser máximo 20 unidades/semana.',
            
            'actividad_fisica.min' => 'La actividad física debe ser mínimo 0 horas/semana.',
            'actividad_fisica.max' => 'La actividad física debe ser máximo 10 horas/semana.',
            
            'calidad_dieta.min' => 'La calidad de dieta debe ser mínimo 4.',
            'calidad_dieta.max' => 'La calidad de dieta debe ser máximo 10.',
            
            'calidad_sueno.min' => 'La calidad de sueño debe ser mínimo 4.',
            'calidad_sueno.max' => 'La calidad de sueño debe ser máximo 10.',
            
            'presion_sistolica.min' => 'La presión sistólica debe ser mínimo 90 mmHg.',
            'presion_sistolica.max' => 'La presión sistólica debe ser máximo 180 mmHg.',
            
            'presion_diastolica.min' => 'La presión diastólica debe ser mínimo 60 mmHg.',
            'presion_diastolica.max' => 'La presión diastólica debe ser máximo 120 mmHg.',
            
            'colesterol_total.min' => 'El colesterol total debe ser mínimo 150 mg/dL.',
            'colesterol_total.max' => 'El colesterol total debe ser máximo 300 mg/dL.',
            
            'colesterol_ldl.min' => 'El colesterol LDL debe ser mínimo 50 mg/dL.',
            'colesterol_ldl.max' => 'El colesterol LDL debe ser máximo 200 mg/dL.',
            
            'colesterol_hdl.min' => 'El colesterol HDL debe ser mínimo 20 mg/dL.',
            'colesterol_hdl.max' => 'El colesterol HDL debe ser máximo 100 mg/dL.',
            
            'trigliceridos.min' => 'Los triglicéridos deben ser mínimo 50 mg/dL.',
            'trigliceridos.max' => 'Los triglicéridos deben ser máximo 400 mg/dL.',
            
            'moca.required' => 'El puntaje MoCA es requerido.',
            'moca.min' => 'El puntaje MoCA debe ser mínimo 0.',
            'moca.max' => 'El puntaje MoCA debe ser máximo 30.',
            
            'medico_encargado.required' => 'El médico encargado es requerido.',
            'medico_encargado.max' => 'El nombre del médico encargado no debe exceder 255 caracteres.',
            
            // Generic messages for binary fields
            '*.in' => 'El valor seleccionado es inválido.',
            '*.required' => 'Este campo es requerido.',
        ]);

        // Additional custom validation rules
        $request->validate([
            'presion_sistolica' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->presion_diastolica && $value <= $request->presion_diastolica) {
                        $fail('La presión sistólica debe ser mayor que la presión diastólica.');
                    }
                },
            ],
        ]);

        try {
            $prediction = new Prediction();
            $prediction->fill($validatedData);
            $prediction->save();

            return response()->json([
                'message' => 'Predicción guardada con éxito',
                'data' => $prediction
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al guardar la predicción',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
