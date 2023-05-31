<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'gender' => fake()->randomElement(array('male', 'female')),
            'blood_type' => fake()->randomElement(array('A', 'B', 'AB', 'O')),
            'allergies' => fake()->randomElement(array('none', 'penicillin', 'aspirin', 'ibuprofen', 'sulfa drugs', 'codeine', 'local anesthetics')),
            'medical_records' => fake()->randomElement(array('none', 'diabetes', 'heart disease', 'high blood pressure', 'high cholesterol', 'asthma', 'arthritis', 'depression', 'kidney disease', 'cancer', 'epilepsy', 'anemia', 'thyroid disease', 'osteoporosis', 'emphysema', 'other')),
        ];
    }
}
