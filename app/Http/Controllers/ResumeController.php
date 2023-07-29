<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumeController extends Controller
{
    public function resumeBuilder(){

        $user = User::findOrFail(Auth::user()->id);

        return view('resume.resume-builder')->with(compact('user'));
    }

    // public function viewResume(){

    //     $user = User::findOrFail(Auth::user()->id);

    //     // Eloquent
    //     // $user_id = Auth::user()->only(['first_name', 'last_name', 'email', 'date_of_birth', 'phone']);

    //     // Query Builder
    //     // $user_id = DB::table('users as u')
    //     //     // ->join('profile_experiences as pe', 'u.id', '=', 'pe.user_id', 'left')
    //     //     ->select(
    //     //         'u.id as user_id', 
    //     //         'u.first_name', 
    //     //         'u.last_name', 
    //     //         'u.email', 
    //     //         'u.date_of_birth', 
    //     //         'u.phone', 
    //     //         'u.street_address',
    //     //         )
    //     //     ->where('u.id', Auth::user()->id)->first();

    //     $user_experience = DB::table('profile_experiences as pe')
    //                         ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
    //                         ->select('pe.*', 'c.city as city_name')
    //                         ->where('user_id', $user->id)
    //                         ->get();

    //     $user_educations = DB::table('profile_educations as pe')
    //                         ->join('degree_levels as dl', 'pe.degree_level_id', '=', 'dl.id', 'left')
    //                         ->join('degree_types as dt', 'pe.degree_type_id', '=', 'dt.id', 'left')
    //                         ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
    //                         ->join('profile_education_major_subjects as ems', 'pe.id', '=', 'ems.profile_education_id', 'left')
    //                         ->join('major_subjects as ms', 'ems.major_subject_id', '=', 'ms.id', 'left')
    //                         ->select(
    //                             'pe.*',
    //                             'dl.degree_level',
    //                             'dt.degree_type',
    //                             'c.city',
    //                             'ms.major_subject'
    //                             )
    //                         ->where('user_id', $user->id)
    //                         ->get();

    //     // dd($user_educations);
    //     return view('resume.view-resume')->with(compact('user', 'user_experience', 'user_educations'));
    // }

    public function viewResumeRef($ref_id){

        $user = User::findOrFail(Auth::user()->id);

        // dd($user->printUserImage());
        

        $user_meta = DB::table('users as u')
            ->join('career_levels as cl', 'u.career_level_id', '=', 'cl.id')
            ->join('cities as c', 'u.city_id', '=', 'c.id')
            ->join('countries as cc', 'u.country_id', '=', 'cc.id')
            ->select(
                'u.id as user_id', 
                'u.first_name', 
                'u.last_name', 
                'u.email', 
                'u.date_of_birth', 
                'u.phone', 
                'u.street_address',
                'c.city',
                'cc.country',
                'cl.career_level'
                )
            ->where('u.id', Auth::user()->id)->first();


        $user_experience = DB::table('profile_experiences as pe')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->select('pe.*', 'c.city as city_name')
                            ->where('user_id', $user->id)
                            ->get();

        $user_educations = DB::table('profile_educations as pe')
                            ->join('degree_levels as dl', 'pe.degree_level_id', '=', 'dl.id', 'left')
                            ->join('degree_types as dt', 'pe.degree_type_id', '=', 'dt.id', 'left')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->join('profile_education_major_subjects as ems', 'pe.id', '=', 'ems.profile_education_id', 'left')
                            ->join('major_subjects as ms', 'ems.major_subject_id', '=', 'ms.id', 'left')
                            ->select(
                                'pe.*',
                                'dl.degree_level',
                                'dt.degree_type',
                                'c.city',
                                'ms.major_subject'
                                )
                            ->where('user_id', $user->id)
                            ->get();

        $user_skills = DB::table('profile_skills as ps')
                            ->join('job_skills as js', 'ps.job_skill_id', '=', 'js.id', 'left')
                            ->join('job_experiences as je', 'ps.job_experience_id', '=', 'je.id', 'left')
                            ->select('ps.id', 'js.job_skill', 'je.job_experience')
                            ->where('user_id', $user->id)
                            ->get();
        // dd($user);
        
        // load selected template blade file
        $view_resume = '';
        if($ref_id === 'temp-1'){
            $view_resume = 'resume.view-resume';
        }else if($ref_id === 'temp-2'){
            $view_resume = 'resume.view-resume-temp-2';
        }else if($ref_id === 'temp-3'){
            $view_resume = 'resume.view-resume-temp-3';
        }else{
            $view_resume = 'resume.resume-builder';
        }


        // update resume exist & resume template only when temp-* file is selected
        if($ref_id === 'temp-1' || $ref_id === 'temp-2' || $ref_id === 'temp-3'){
            // update for resume exist
            $is_resume_update = User::where('id', Auth::user()->id)->update(['is_resume' => '1']);

            // update resume template
            $resume_temp = User::where('id', Auth::user()->id)->update(['resume_temp' => $ref_id]);
        }

        return view($view_resume)->with(compact('user', 'user_meta', 'user_experience', 'user_educations', 'user_skills'));

    }

    // public function viewResumeTemp2(){
    //     return view('resume.view-resume-temp-2');
    // }
    // public function viewResumeTemp3(){
    //     return view('resume.view-resume-temp-3');
    // }

    public function resumePDF(){
        $data = [
        'foo' => 'bar'
        ];

        // $pdf = PDF::loadView('resume.document', compact( 'data'));
        // // return $pdf->download('Invoice#.pdf');
        // return $pdf->stream('document.pdf');

        $html = '';
        
        $view = view('resume.document')->with(compact('data'));
        $html .= $view->render();
        // }
        $pdf = PDF::loadHTML($html,[
          'format'                => 'A4',
          'margin_left'           => 10,
          'margin_right'          => 10,
          'margin_top'            => 10,
          'margin_bottom'         => 10,
          'margin_header'         => 0,
          'margin_footer'         => 0,
        ]);

        return $pdf->stream('Resume.pdf');
    }

    public function downloadResume(){
        // $data = [
        // 'foo' => 'bar'
        // ];

        // $pdf = PDF::loadView('resume.document', compact( 'data'));
        // // return $pdf->download('Invoice#.pdf');
        // return $pdf->stream('document.pdf');

        $user = User::findOrFail(Auth::user()->id);
        $user_meta = DB::table('users as u')
            ->join('career_levels as cl', 'u.career_level_id', '=', 'cl.id')
            ->join('cities as c', 'u.city_id', '=', 'c.id')
            ->join('countries as cc', 'u.country_id', '=', 'cc.id')
            ->select(
                'u.id as user_id', 
                'u.first_name', 
                'u.last_name', 
                'u.email', 
                'u.date_of_birth', 
                'u.phone', 
                'u.street_address',
                'c.city',
                'cc.country',
                'cl.career_level'
                )
            ->where('u.id', Auth::user()->id)->first();


        $user_experience = DB::table('profile_experiences as pe')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->select('pe.*', 'c.city as city_name')
                            ->where('user_id', $user->id)
                            ->get();

        $user_educations = DB::table('profile_educations as pe')
                            ->join('degree_levels as dl', 'pe.degree_level_id', '=', 'dl.id', 'left')
                            ->join('degree_types as dt', 'pe.degree_type_id', '=', 'dt.id', 'left')
                            ->join('cities as c', 'pe.city_id', '=', 'c.id', 'left')
                            ->join('profile_education_major_subjects as ems', 'pe.id', '=', 'ems.profile_education_id', 'left')
                            ->join('major_subjects as ms', 'ems.major_subject_id', '=', 'ms.id', 'left')
                            ->select(
                                'pe.*',
                                'dl.degree_level',
                                'dt.degree_type',
                                'c.city',
                                'ms.major_subject'
                                )
                            ->where('user_id', $user->id)
                            ->get();

        $user_skills = DB::table('profile_skills as ps')
                            ->join('job_skills as js', 'ps.job_skill_id', '=', 'js.id', 'left')
                            ->join('job_experiences as je', 'ps.job_experience_id', '=', 'je.id', 'left')
                            ->select('ps.id', 'js.job_skill', 'je.job_experience')
                            ->where('user_id', $user->id)
                            ->get();

        $html = '';
        
        $view = view('resume.download')->with(compact('user', 'user_meta', 'user_experience', 'user_educations', 'user_skills'));
        $html .= $view->render();
        // }
        $pdf = PDF::loadHTML($html);

        return $pdf->stream('Resume.pdf');
    }

    

}
