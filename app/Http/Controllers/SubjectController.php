<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use App\Subject;
use Laracasts\Flash\Flash;
class SubjectController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$subjects=Subject::paginate(10);

		return view('subject.index',array('subjects' => $subjects));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$teachers = User::whereHas('roles', function ($query) {
			$query->where('name', '=', 'staff');
		})->get();
		return view('subject.create',array('teachers'=>$teachers));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'subject' => 'required',
			'active' => 'required',
			'desc' => 'required|max:1000',
		]);

		$subject=new Subject();
		$subject->subject = $request->subject;
		$subject->active = $request->active;
		$subject->desc = $request->desc;
		$subject->user_id = $request->teacher_id;
		$subject->save();
		Flash::success('Subject add successfully');
		return redirect()->route('subjects.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
//	public function show($id)
//	{
//		//
//	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$subject = Subject::find($id);

		$teachers = User::whereHas('roles', function ($query) {
			$query->where('name', '=', 'staff');
		})->get();

		return view('subject.edit',array('subject'=>$subject,'teachers'=>$teachers));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'subject' => 'required',
			'active' => 'required',
			'desc' => 'required|max:1000',
		]);

		$subject= Subject::find($id);
		$subject->subject = $request->subject;
		$subject->active = $request->active;
		$subject->desc = $request->desc;
		$subject->user_id = $request->teacher_id;
		$subject->save();
		Flash::success('Subject update successfully');
		return redirect()->route('subjects.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$subject = Subject::find($id);
		$subject->delete();
		Flash::success('Subject delete successfully');
		return redirect()->route('subjects.index');
	}

}
