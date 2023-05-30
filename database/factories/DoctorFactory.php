<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'specialization' => fake()->randomElement([
                'Neurology',
                'Cardiology',
                'Dermatology',
                'Gastroenterology',
                'Ophthalmology',
                'Oncology',
                'Psychiatry',
                'Urology',
                'Rheumatology',
                'Pulmonology',
                'Endocrinology',
                'Nephrology',
                'Gynecology',
                'Pediatrics',
                'Orthopedics',
                'Otolaryngology',
                'Anesthesiology',
                'Radiology',
                'Emergency Medicine',
                'Family Medicine',
                'General Practice',
                'Internal Medicine',
                'Pathology',
                'Preventive Medicine',
                'Physical Medicine',
                'Rehabilitation',
                'Plastic Surgery',
                'Thoracic Surgery',
                'Colon and Rectal Surgery',
                'Obstetrics and Gynecology',
                'General Surgery',
                'Neurosurgery',
                'Vascular Surgery',
                'Cardiac Surgery',
                'Ophthalmic Surgery',
                'Oral and Maxillofacial Surgery',
                'Orthopedic Surgery',
                'Otolaryngology',
                'Pediatric Surgery',
                'Urology',
                'Anesthesiology',
                'Dermatology',
                'Emergency Medicine',
                'Family Medicine',
                'Internal Medicine',
                'Neurology',
                'Pathology',
                'Pediatrics',
                'Psychiatry',
                'Radiology',
                'Surgery'
            ]),
            'qualification' => fake()->randomElement(['MBBS', 'MD', 'MS', 'DM', 'MCh', 'DNB', 'BDS', 'MDS']),
            'experience' => fake()->numberBetween(1, 50),
        ];

    }
}
