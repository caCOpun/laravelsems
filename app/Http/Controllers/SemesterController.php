<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Semester;
use Laracasts\Flash\Flash;

class SemesterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$semesters=Semester::paginate(10);
		return view('semester.index',array('semesters' => $semesters));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('semester.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'semester' => 'required',
			'active' => 'required',
			'desc' => 'required|max:1000',
		]);

		$semester=new Semester;
		$semester->semester = $request->semester;
		$semester->active = $request->active;
		$semester->desc = $request->desc;
		$semester->save();
		Flash::success('Semester add successfully');
		return redirect()->route('semesters.index');
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
		$semester = Semester::find($id);
		return view('semester.edit',array('semester'=>$semester));
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
			'semester' => 'required',
			'active' => 'required',
			'desc' => 'required|max:1000',
		]);

		$semester= Semester::find($id);
		$semester->semester = $request->semester;
		$semester->active = $request->active;
		$semester->desc = $request->desc;
		$semester->save();
		Flash::success('Semester update successfully');
		return redirect()->route('semesters.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$semester = Semester::find($id);
		$semester->delete();
		Flash::success('Semester delete successfully');
		return redirect()->route('semesters.index');
	}

}
