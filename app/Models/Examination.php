<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_date',
        'day',
        'exam_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function glassesPrescription()
    {
        return $this->hasOne(GlassesPrescription::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
