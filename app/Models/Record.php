<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $table = "records";
    protected $fillable = [
        'user_id',
        'course_id',
    ];
    public function user()
    {
        return $this->belongsTo('App/Models/User');
    }
    public function course()
    {
        return $this->belongsTo('App/Models/Course');
    }
    public function activities()
    {
        return $this->hasMany('App/Models/Activitie');
    }
}
