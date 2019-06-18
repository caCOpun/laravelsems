<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Semester;
use App\Student;
use App\Subject;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $students=Student::paginate(10);
        return view('student.index',array('students' => $students));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //one to many
        $years = Year::where('active', '=', '1')->get();
        $semesters = Semester::where('active', '=', '1')->get();
        //many to many
        $subjects = Subject::where('active', '=', '1')->get();

        return view('student.create', array('years' => $years, 'semesters' => $semesters, 'subjects' => $subjects));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'identification_number' => 'required|max:15',

            'age' => 'required',
            'gender' => 'required',
            'birthday' => 'required|max:15',
            'desc' => 'required',
        ]);

        $student = new Student;
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->identification_number = $request->identification_number;
        $student->age = $request->age;
        $student->gender = $request->gender;
        $student->birthday = $request->birthday;
        $student->active = $request->active;
        $student->desc = $request->desc;
        $student->year = $request->year;
        $student->semester = $request->semester;

        $student->save();
        $student->subjects()->sync($request->subject, false);
        Flash::success('Student add successfully');
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $student=Student::find($id);
        return view('student.show',array('student'=>$student));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $years = Year::where('active','=','1')->get();
        $semesters = Semester::where('active','=','1')->get();
        $subjects = Subject::all();
        return view('student.edit',array('student'=>$student,'years'=>$years,'semesters'=>$semesters,'subjects'=>$subjects));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'identification_number' => 'required|max:15',

            'age' => 'required',
            'gender' => 'required',
            'birthday' => 'required|max:15',
            'desc' => 'required',
        ]);

        $student = Student::find($id);
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->identification_number = $request->identification_number;
        $student->age = $request->age;
        $student->gender = $request->gender;
        $student->birthday = $request->birthday;
        $student->active = $request->active;
        $student->desc = $request->desc;
        $student->year = $request->year;
        $student->semester = $request->semester;

        $student->save();
       // $student->subjects()->sync($request->subject, false);

        $student->subjects()->sync($request->subject);

        Flash::success('Student updated successfully');
        return redirect()->route('students.index');
    }

    public function getAddNote($id){
        $student=Student::find($id);
        return view('student.addNote',array('student'=>$student));
    }

    public function postAddNote(Request $request){
        $student=Student::find($request->idStudent);
        $userId=Auth::user()->id;
        $subjectId=Subject::find($request->id)->user_id;
        if($userId==$subjectId){
            $student->subjects()->updateExistingPivot($request->id, array('note' => $request->note), false);
            Flash::success('Note push in system');
        }else{
            Flash::error('You are not a teacher');
        }
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        Flash::success('Student delete successfully');
        return redirect()->route('students.index');
    }

}
