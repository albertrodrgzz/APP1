<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'check_in',
        'check_out',
        'date',
        'total_hours',
        'overtime_hours',
        'status',
        'notes',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'date' => 'date',
        'total_hours' => 'decimal:2',
        'overtime_hours' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function calculateTotalHours()
    {
        if ($this->check_in && $this->check_out) {
            $totalMinutes = $this->check_out->diffInMinutes($this->check_in);
            $this->total_hours = round($totalMinutes / 60, 2);
            
            // Calcular horas extra (más de 8 horas)
            if ($this->total_hours > 8) {
                $this->overtime_hours = $this->total_hours - 8;
            } else {
                $this->overtime_hours = 0;
            }
        }
    }

    public function getFormattedCheckInAttribute()
    {
        return $this->check_in ? $this->check_in->format('H:i:s') : '--:--:--';
    }

    public function getFormattedCheckOutAttribute()
    {
        return $this->check_out ? $this->check_out->format('H:i:s') : '--:--:--';
    }
}

