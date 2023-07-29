<?php


Route::get('resume-builder', 'ResumeController@resumeBuilder')->name('resume.builder');
// Route::get('view-resume', 'ResumeController@viewResume')->name('view.resume');
// Route::get('view-resume-temp-2', 'ResumeController@viewResumeTemp2')->name('view.resume.temp.2');
// Route::get('view-resume-temp-3', 'ResumeController@viewResumeTemp3')->name('view.resume.temp.3');
Route::get('view-resume/{ref_id}', 'ResumeController@viewResumeRef')->name('view.resume.ref');


// Route::get('pdf-resume', 'ResumeController@resumePDF')->name('resume.pdf');
Route::get('download-resume', 'ResumeController@downloadResume')->name('download.resume');

