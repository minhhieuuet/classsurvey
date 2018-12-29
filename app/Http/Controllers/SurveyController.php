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
     //Admin Survey Homepage
    public function index()
    {
      $surveys = Survey::orderBy('id','DESC')->paginate(20);
        return view('survey.surveyList',compact('surveys'));
    }

    // Show all courses
    public function changeDefault($id){
      $survey = Survey::findOrFail($id);
      Survey::query()->update(['default'=>false]);

      if($survey -> default == true){
        $survey -> default = false;
      }else{
        $survey -> default = true;
      }
      $survey -> save();
      return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //Create Survey
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

     //Store Survey
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

     //Show survey information
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

     //Edit Survey Content
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

     //Post Edit Survey Content
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

     //Delete a survey from database
    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);
        $survey -> delete();
        return redirect()->back()->with('del-success','Xóa thành công');
    }
}
