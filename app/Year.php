<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model {

    protected $table = 'years';
    protected $fillable = ['school_flow','active', 'desc'];

    public function students(){
        return $this->hasMany('App\Student');
    }
//    public function semesters(){
//        return $this->hasMany('App\Semester');
//    }

}
