<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Resume - Template 1</title>
  <link rel="stylesheet" href="{{ public_path('css/templates/download-resume.css') }}">
  

  <style>
    /* .resume_profile{
      align-items: center;
      display: flex;
      justify-content: center;
    } */
    /* .resume .resume_left .resume_profile img {
      width: 35%;
      height: 35%;
    }  */
  </style>
</head>
<body>

<div class="resume">
   <div class="resume_left">
     <div class="resume_profile">
      <?php
      $user_imgg = 'user_images/'.Auth::user()->image;
      ?>
      <img src="{{ public_path($user_imgg) }}" alt="profile_pic" width="200" height="200" style="margin-top: 55px;">
      <!-- <img src="{{ public_path('user_images/'.Auth::user()->image) }}" alt="profile_pic" width="200" height="200" style="margin-top: 55px;"> -->
     </div>
     <div class="resume_content">
       <div class="resume_item resume_info">
         <div class="title">
           <p class="bold">{{ $user->first_name . ' ' . $user->last_name }}</p>
           <p class="regular">{{ $user_meta->career_level }}</p>
         </div>

         <ul>
            <li>
             <div class="icon">
               <i class="fa fa-map-signs"></i>
             </div>
             <div class="data">
               <!-- 21 Street, Al Batinah, <br />Liwa, Oman -->
               {{ $user->street_address }}
             </div>
           </li>
           <li>
             <div class="icon">
               <i class="fa fa-mobile"></i>
             </div>
             <div class="data">
              {{ $user->phone }}
             </div>
           </li>
           <li>
             <div class="icon">
               <i class="fa fa-envelope"></i>
             </div>
             <div class="data">
              {{ $user->email }}
             </div>
           </li>
           <!-- <li>
             <div class="icon">
               <i class="fa fa-globe"></i>
             </div>
             <div class="data">
                www.candi_date.com
             </div>
           </li> -->
         </ul>
       </div>
       <div class="resume_item resume_skills">
         <div class="title">
           <p class="bold">skill's</p>
         </div>
         <ul>
           <li>
             <div class="skill_name">
               HTML
             </div>
             <div class="skill_progress">
               <span style="width: 95%;"></span>
             </div>
             <div class="skill_per">95%</div>
           </li>
           <li>
             <div class="skill_name">
               CSS
             </div>
             <div class="skill_progress">
               <span style="width: 85%;"></span>
             </div>
             <div class="skill_per">85%</div>
           </li>
           <li>
             <div class="skill_name">
               JS
             </div>
             <div class="skill_progress">
               <span style="width: 75%;"></span>
             </div>
             <div class="skill_per">75%</div>
           </li>
           <li>
            <div class="skill_name">
              MySQL
            </div>
            <div class="skill_progress">
              <span style="width: 80%;"></span>
            </div>
            <div class="skill_per">80%</div>
           </li>
           <li>
             <div class="skill_name">
               PHP
             </div>
             <div class="skill_progress">
               <span style="width: 90%;"></span>
             </div>
             <div class="skill_per">90%</div>
           </li>
         </ul>
       </div>
       <div class="extra_spacing">&nbsp;</div>
       </div>
  </div>
  <div class="resume_right">
    <div class="resume_item resume_about">
        <div class="title">
           <p class="bold">About me</p>
         </div>
        <p>{{$user->getProfileSummary('summary')}}</p>
    </div>
    <div class="resume_item resume_work">
        <div class="title">
           <p class="bold">Work Experience</p>
         </div>
        <ul>
          @foreach($user_experience as $user_exp)
            <li>
              <div class="date">
                {{ 'From ' . date('d M, Y', strtotime($user_exp->date_start)) . ' - ' . date('d M, Y', strtotime($user_exp->date_end)) }}
              </div>
              <div class="info">
                     <p class="semi-bold">{{ $user_exp->company . ' | ' . $user_exp->city_name}}</p> 
                     <p>{{ $user_exp->title}}</p>
                  <p>{{ $user_exp->description }}</p>
              </div>
            </li>
          @endforeach
        </ul>
    </div>
    <div class="resume_item resume_education">
      <div class="title">
           <p class="bold">Education</p>
         </div>
      <ul>
            @foreach($user_educations as $user_edu)
              <li>
                <div class="date" style="margin-bottom: 0;">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</div> 
                <div style="margin-bottom: 10px;">{{ $user_edu->date_completion . ' - ' . $user_edu->city }}</div> 
                <div class="info">
                  <p class="semi-bold">{{ $user_edu->degree_title . ' (' . $user_edu->institution . ')' }}</p> 
                  <p>{{ $user_edu->major_subject }}</p>
                </div>
              </li>
            @endforeach
        </ul>
    </div>
  </div>
  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
</div>
  
</body>
</html>