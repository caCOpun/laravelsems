<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Year;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class YearController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$years=Year::paginate(10);
		return view('year.index',array('years' => $years));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('year.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'school_flow' => 'required',
			'active' => 'required',
			'desc' => 'required|max:1000',
		]);

		$year=new Year;
		$year->school_flow = $request->school_flow;
		$year->active = $request->active;
		$year->desc = $request->desc;
		$year->save();
		Flash::success('Year add successfully');
		return redirect()->route('years.index');
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
		$year = Year::find($id);
		return view('year.edit',array('year'=>$year));
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
			'school_flow' => 'required',
			'active' => 'required',
			'desc' => 'required|max:1000',
		]);
		$year = Year::find($id);
		$year->school_flow = $request->school_flow;
		$year->active = $request->active;
		$year->desc = $request->desc;
		$year->save();
		Flash::success('Year update successfully');
		return redirect()->route('years.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$year = Year::find($id);
		$year->delete();
		Flash::success('Year delete successfully');
		return redirect()->route('years.index');
	}

}
