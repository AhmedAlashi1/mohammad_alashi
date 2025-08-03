<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlassesPrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'examination_id',
        'sph_od', 'cyl_od', 'axis_od', 'add_od', 'prism_od', 'sci_od',
        'sph_os', 'cyl_os', 'axis_os', 'add_os', 'prism_os', 'sci_os',
        'ipd', 'notes',
        'lens_type', 'lens_purchase_price', 'lens_selling_price',
        'inventory_id', 'frame_price', 'other_costs', 'consultation_cost', 'total_cost',
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
