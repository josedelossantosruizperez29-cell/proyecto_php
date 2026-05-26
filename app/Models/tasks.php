<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    use HasFactory,SoftDeletes;

    public function isOverdue(){
        return $this->due_date < now() && $this->status == 'Pendiente'; 
    }
    protected $fillable=[
        'title',
        'description',
        'status',
        'due_date',
        'project_id'
    ];
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
