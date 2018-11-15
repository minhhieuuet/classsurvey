<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $surveys = Survey::orderBy('id','DESC')->paginate(20);
        return view('survey.surveyList',compact('surveys'));
    }

    // Show all course


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('survey.surveyAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Survey::create(['name'=>$request->name,'content'=>Survey::makeContent($request->fields)]);
        return redirect('admin/khao-sat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $survey = Survey::findOrFail($id);
      return view('survey.surveyView',compact('survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        return view('survey.surveyEdit',compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);
        $survey -> name = $request -> name;
        $survey -> content = Survey::makeContent($request->fields);
        $survey -> save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);
        $survey -> delete();
        return redirect()->back()->with('del-success','Xóa thành công');
    }
}
