<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Checklist;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_completed',
        'checklist_id',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
