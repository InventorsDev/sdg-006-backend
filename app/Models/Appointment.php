<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use App\Traits\UsesUuidTrait;

class Appointment extends Model
{
    use UsesUuidTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'medfiles', 'patient_id','specialist_id','video_call', 'time_frame', 'time_from', 'time_to', 'appointment_day', 'appointment_month', 'appointment_year'
    ];
    public function patient()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }

    public function specialist()
    {
        return $this->belongsTo('App\User', 'specialist_id');
    }

    public function getMedfilesAttribute($value)
    {
        return json_decode($value);
    }
}
