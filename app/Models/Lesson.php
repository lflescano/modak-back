<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'subject_id',
    ];

    protected  $hidden = [
        'created_at',
        'updated_at',
        'pivot',
        'subject_id,'
    ];
    
    /**
     * El usuario de usuario unidad.
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * La unidad facturacion de usuario unidad.
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
}
