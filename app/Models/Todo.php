<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['task', 'date', 'completed'];
    
    protected $casts = [
        'date' => 'datetime',
        'completed' => 'boolean'
    ];
    
    // Optional: Für zusätzliche Datumsmethoden
    public function getFormattedDateAttribute()
    {
        return $this->date?->format('d.m.Y');
    }
}