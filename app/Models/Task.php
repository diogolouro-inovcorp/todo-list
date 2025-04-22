<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
      'title',
      'description',
      'priority',
      'due_date',
      'completed',
    ];


    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'date',
    ];
}
