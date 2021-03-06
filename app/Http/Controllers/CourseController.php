<?php

namespace App\Http\Controllers;
use App\Survey;
use Illuminate\Http\Request;
use App\Course;
use App\Student;
use App\TeacherAccount;
use App\Student_Course;
use App\StudentAccount;
use App\User;
use Excel;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //Course home page
    public function index()
    {
        $courses = Course::orderBy('id','DESC')->paginate(10);
        $teacherCount = TeacherAccount::count();
        $studentCount = StudentAccount::count();
        return view('course.index',compact('courses','teacherCount','studentCount'));
    }
    // Course info and caculating result of course
    public function courseInfo($id){
        $course = Course::findOrFail($id);
        $results = Course::find($id)->results;

        $arr = json_decode(json_encode($results));
        $resultsArr = [];

        foreach($arr as $item){
          array_push($resultsArr,json_decode($item->content,true));
        }
        $input = $resultsArr;
        $survey_keys = [];
        foreach($input as $sinhvien) {
        	$keys = array_keys($sinhvien);
        	$survey_keys = array_merge($survey_keys, $keys);
        }
        $survey_keys = array_unique($survey_keys);

        $survey_values = array_fill(0, sizeof($survey_keys), 0);

        $survey_result = array_combine($survey_keys, $survey_values);

        $survey = array_fill(0, sizeof($input), $survey_result);

        $i = 0;
        foreach($input as $sinhvien) {
           	foreach($sinhvien as $key => $value) {
           		$survey[$i][$key] = $sinhvien[$key];
            }
            $i++;
        }

        $count = $survey_result;

        // gia tri trung binh
        $sum1 = $survey_result;
        foreach($survey as $sinhvien) {
        	foreach($sinhvien as $key => $value) {
        		if($value > 0) {
        			$sum1[$key] += $value;
        			$count[$key]++;
        		}
           }
        }
        $result1 = $survey_result;
        foreach($result1 as $key => $value) {
        	$result1[$key] = $sum1[$key]/$count[$key];
        }



        $sum2 = $survey_result;
        foreach($survey as $sinhvien) {
        	foreach($sinhvien as $key => $value) {
        		if($value > 0) {
        			$temp = ($value - $result1[$key]);
        			$temp = pow($temp, 2);
        			$sum2[$key] += $temp;
        		}
           }
        }

        $result2 = $survey_result;
        foreach($result2 as $key => $value) {
        	if($count[$key] == 1) {
        		$result2[$key] = $sum2[$key]/($count[$key]);
        	}
        	else {
        		$result2[$key] = $sum2[$key]/($count[$key]-1);
        	}
        	$result2[$key] = sqrt($result2[$key]);
        }

        return view('course.result',compact('course','survey_keys','result1','result2'));

    }
    // Show all course and result

    public function list(){
      $courses = Course::all();
      return view('course.list',compact('courses'));
    }


    // import courses and students from file
    public function import(Request $request){


      if($request->hasFile('file')){

        $file = $request -> file;

        $this->createCourseAndSurvey($file);
        $this->createStudentAndCourse($file);
      };


      return redirect()->back();
    }

    //Create student and course from file
    protected function createStudentAndCourse($file){
      config(['excel.import.startRow' => 11]);
      $data = Excel::load($file, function($reader) {
        $reader->limitRows(100);
        $results = $reader->toArray();
        foreach( $results as $result){
          if($result['ma_sv']!=null){
            // Create student
            $student =  Student::updateOrCreate(['student_code'=>$this->trim_str($result['ma_sv'])],
            ['student_code'=>$this->trim_str($result['ma_sv']),
            'name'=>$result['ho_va_ten'],
            'school_year'=>$result['lop_khoa_hoc']]);
             Student_Course::create(['student_id'=>$student['id'],'course_id'=>Course::orderBy('id','DESC')->first()['id']]);

             //Create default student accounts
             StudentAccount::firstOrCreate(['username'=>$this->trim_str($result['ma_sv'])],[
             'username'=>$this->trim_str($result['ma_sv']),
             'full_name'=>$result['ho_va_ten']
             ,'vnu_mail'=>$result['ma_sv']."@vnu.edu.vn",
             'school_year'=>$result['lop_khoa_hoc']]);
             User::firstOrCreate(['name'=>$result['ma_sv']],[
               'name'=>$result['ma_sv'],
               'password'=>bcrypt('12345678'),
               'email'=>$result['ma_sv']."@vnu.edu.vn",
               'role'=>'3'
             ]);
          }
        }

      });
    }

    //Create course and survey from file
    protected function createCourseAndSurvey( $file ){
      Excel::load($file, function($doc) {
      $sheet = $doc->getSheetByName('DSLMH');
      $defaultSurvey = Survey::where('default',1)->first();
      // Create survey
      $survey = new Survey();
      $survey -> name = $sheet->getCell('C9')->getValue();
      if($defaultSurvey){
        $survey -> content = $defaultSurvey['content'];
      }else{
        $survey -> content = json_encode([]);
      }

      $survey -> save();

      // Create course

      $course = new Course();
      $course -> survey_id = $survey -> id;
      $course -> name = $sheet->getCell('C10')->getValue();
      $course -> code = $sheet->getCell('C9')->getValue();
      $course -> teacher_name = $sheet->getCell('C7')->getValue();
      $course -> teacher_account_id = TeacherAccount::where('full_name','like','%'.$sheet->getCell('C7')->getValue().'%')->first()['id'];
      $course -> save();
    });
  }

  //Destroy course
    public function destroy($id)
    {
        //Delete if exist
        Course::findOrFail($id)->delete();
        return redirect()->back()->with('del-success','Done');
    }


}
