<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'title',
        'description',
        'user_id'
    ];
    //funcion para identificar que ese project pertenece a ese usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    //funcion para ifenttificar que un project puede tener muchas tareas
    public function tasks(){

        return $this->hasMany(tasks::class);
    }
}
