<?php
namespace App\Services;

use App\Models\Examination;
use App\Models\GlassesPrescription;
use Illuminate\Support\Carbon;

class ExaminationService
{
    public function storeExamination(array $data): Examination
    {
        $examDate = Carbon::parse($data['exam_date']);
        $day = $examDate->format('l');

        $examination = Examination::create([
            'user_id'   => $data['user_id'],
            'exam_date' => $examDate,
            'day'       => $day,
            'exam_type' => $data['exam_type'],
        ]);

        if ($data['exam_type'] === 'consultation_with_glasses') {
            GlassesPrescription::create([
                'examination_id'        => $examination->id,

                // Right Eye (OD)
                'sph_od'                => $data['sph_od'] ?? null,
                'cyl_od'                => $data['cyl_od'] ?? null,
                'axis_od'               => $data['axis_od'] ?? null,
                'add_od'                => $data['add_od'] ?? null,
                'prism_od'              => $data['prism_od'] ?? null,
                'sci_od'                => $data['sci_od'] ?? null,

                // Left Eye (OS)
                'sph_os'                => $data['sph_os'] ?? null,
                'cyl_os'                => $data['cyl_os'] ?? null,
                'axis_os'               => $data['axis_os'] ?? null,
                'add_os'                => $data['add_os'] ?? null,
                'prism_os'              => $data['prism_os'] ?? null,
                'sci_os'                => $data['sci_os'] ?? null,

                // Extras
                'ipd'                   => $data['ipd'] ?? null,
                'notes'                 => $data['notes'] ?? null,
                'inventory_id'          => $data['inventory_id'] ?? null,

                // Pricing
                'lens_type'             => $data['lens_type'] ?? null,
                'lens_purchase_price'   => $data['lens_purchase_price'] ?? 0,
                'lens_selling_price'    => $data['lens_selling_price'] ?? 0,
                'frame_price'           => $data['frame_price'] ?? 0,
                'other_costs'           => $data['other_costs'] ?? 0,
                'consultation_cost'     => $data['consultation_cost'] ?? 0,

                // Calculated
                'total_cost'            => collect([
                        $data['lens_selling_price'] ?? 0,
                        $data['frame_price'] ?? 0,
                        $data['other_costs'] ?? 0,
                        $data['consultation_cost'] ?? 0
                ])->sum(),
            ]);
        }

        return $examination;
    }
}
