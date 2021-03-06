<?php

namespace App\Http\Controllers;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;

class DynamicPageController extends Controller
{
    private $students;
    private $genders;

    public function __construct()
    {
    $this->students = config('students.students');
    $this->genders = config('students.genders');
    }
    
    public function index()
    {
        $data = [
            'students'=> $this->students,
            'gender'=> $this->genders 
        ];
        return view('studentpage.index', $data);
    }

    // public function show($slug = null)
    // {
    //     $search = false;
    //     $thisStudente = [];
    //     foreach ($this->students as $studente) {
    //         if ($slug == $studente['slug']){
    //             $thisStudente[] = $studente;
    //             $search = true;
    //             //dd($thisStudente);
    //         }
    //     }
    //     if($search){
    //         //dd($thisStudente);
    //         return view('studentpage.show', ['student' => $thisStudente]);  
    //     } else {
    //         return abort('404');
    //     }  
    // }


    public function show($slug)
    {
        $thisStudent = [];
        foreach ($this->students as $student) {
            if($student['slug'] == $slug){
                $thisStudent[] = $student;
            }
        }  
        return view('studentpage.show', ['student' => $thisStudent]);
    }

    public function getId($id){
         foreach ($this->students as $key => $student) {
            if ($key == $id) {
            return view('studentpage.show', ['student' => $this->students[$id]]);
            }
        }
     return abort('404');
    }

    public function getAltroId($id){
        foreach ($this->students as $key => $student) {
            if ($key == $id) {
            return view('studentpage.show', ['student' => $this->students[$id]]);
            }
        }
    return abort('404');
   }

    public function getGenere($genere)
    {
        $allGenere = [];
        foreach ($this->students as $student) {
            
            if($student['genere'] == $genere){
                //dd($student['genere']);
                $allGenere[] = $student;
                //dd($allGenere);
            }
        }
        return view('showstudent', ['students' => $allGenere]);
    }

    public function getAllDbStudents()
    {
        $this->students = Student::all();
        dd($this->students);

        return view('showstudent', $this->students);
        }

    public function getAllDbTeachers()
    {
        $this->teachers = Teacher::all();
        dd($this->teachers);

        return view('showstudent', $this->teachers);
        
    }



    public function getEta($eta)
    {
        $search = false;
        $thisEta = [];
        foreach ($this->students as $key => $studente) {
            if ($eta == $studente['etal']){
                $thisEta[] = $studente;
                $search = true;
            }
        }
        if($search){
            return view('studentpage.show', ['student' => $thisEta]);
        } else {
            abort('404');
        }
       
    }

    public function getAllStudents(){
        $students=$this->students;
        return view('showstudent', ['students' => $students]);
    }

   
}
