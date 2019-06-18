<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table = 'students';
    protected $fillable = ['name','surname', 'identification_number','age','gender','birthday', 'active','desc','year','semester'];


    //many to many
	public function subjects(){
        return $this->belongsToMany('App\Subject')->withPivot('student_id', 'subject_id','note','active');
    }

//    public function subjectsInsert() {
//        return $this->hasMany(Subject::class);
//    }

}
