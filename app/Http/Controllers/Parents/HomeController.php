<?php

namespace App\Http\Controllers\Parents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	
	/**
	* Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
		$user = \Auth::user();
		
		$respuesta = [];
		
		foreach($user->childrens as $student) {
			$queryStr = "SELECT c.id, c.name, count(1) as total, sum(case when scored = 1 then 1 else 0 end) as total_evaluadas
                    from activities a
                        join courses c on a.course_id  = c.id 
                    where c.grade_id = :grade_id
                    group by c.id, c.name";
			
			$totales = \DB::select( \DB::raw($queryStr), [
						            'grade_id' => $student->grade_id
			        ]);
			$queryStr = "SELECT c.id, c.name, count(1) as total, sum(case when scored = 1 then 1 else 0 end) as total_evaluadas
                    from activities a
                        join courses c on a.course_id  = c.id 
                        join user_activities ua on a.id = ua.activity_id 
                    where c.grade_id = :grade_id 
                        and ua.user_id = :user
                        and ua.deleted_at is null
                    group by c.id, c.name
                    order by c.id";
			$respondidasDB = \DB::select( \DB::raw($queryStr), [
			            'grade_id' => $student->grade_id,
			            'user' => $student->id,
			        ]);
			$respondidas = [];
			foreach($respondidasDB as $respondida) {
				$respondidas[$respondida->id] = $respondida;
			}
			foreach($totales as $total) {
				$resp = isset($respondidas[$total->id])?$respondidas[$total->id]:null;
				$total->total_evaluadas = (int) $total->total_evaluadas;
				$total->respondidas_total = $resp==null? 0 : (int)$resp->total;
				$total->respondidas_total_evaluadas = $resp==null? 0 : (int)$resp->total_evaluadas;
			}
			$respuesta[] = [
				'student' => $student,
                'totales' => $totales
            ];
		}
		return view('parents/home', [
		            'respuestas' => $respuesta
		        ]);
    }
    

    public function calendars() {
		$user = \Auth::user();
        
        $grades = [];
        foreach($user->childrens as $student) {
            $grades[] = $student->grade;
        }

        return view('parents/calendars', [
            'grades' => $grades
        ]);
    }
}
