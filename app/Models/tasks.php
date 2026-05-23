<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    protected $fillable=[
        'title',
        'desscription',
        'status',
        'due_date',
        'project_id'
    ];
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
