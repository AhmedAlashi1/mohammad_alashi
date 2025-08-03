<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'examination_id',
        'amount',
        'reason',
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }

}
