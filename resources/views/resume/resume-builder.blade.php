<!-- @extends('layouts.app') -->
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
<!-- @include('includes.inner_page_title', ['page_title'=>__('Applied Jobs')]) -->
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.user_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
                @if($user->is_resume == '1')
                <div class="myads">
                    <h3>My Resume</h3>
                    <ul class="searchList">
                        <li>
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="jobimg">
                                        @if($user->resume_temp == 'temp-1')
                                            <img src="{{ asset('resumes/template-1.png') }}" alt="" title="">
                                        @elseif($user->resume_temp == 'temp-2')
                                            <img src="{{ asset('resumes/template-2.jpg') }}" alt="" title="">
                                        @else
                                            <img src="{{ asset('resumes/template-3.png') }}" alt="" title="">
                                        @endif
                                    </div>

                                    <div class="jobinfo">
                                        <h3><a href="#" title="Download Resume">
                                            @if($user->resume_temp == 'temp-1')
                                                Template 1
                                            @elseif($user->resume_temp == 'temp-2')
                                                Template 2
                                            @else
                                                Template 3
                                            @endif
                                        </a></h3>
                                        <div class="location">
                                            <label class="fulltime">My Resume</label>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="listbtn mt-0"><a href="#">{{__('Download Resume')}}</a></div>
                                </div>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem eos reiciendis, voluptatem repudiandae ea distinctio, eveniet modi soluta officia possimus rem odit placeat deserunt.</p>
                        </li>
                    </ul>
                </div>
                @endif

                <div class="myads">
                    <h3>Resume Templates</h3>
                    <p>Select Resume Template</p>

                    <div class="container mt-4">
                    <div class="row cv-templates">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="cv-template border p-4">
                                <a href="{{ url('view-resume/temp-1') }}" target="_blank">
                                    <figure>
                                        <figcaption class="text-center mb-3">Template 1</figcaption>
                                        <img src="{{ asset('resumes/template-1.png') }}" alt="" class="w-100">
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="cv-template border p-4">
                                <a href="{{ url('view-resume/temp-2') }}" target="_blank">
                                    <figure>
                                        <figcaption class="text-center mb-3">Template 2</figcaption>
                                        <img src="{{ asset('resumes/template-2.jpg') }}" alt="" class="w-100">
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="cv-template border p-4">
                                <a href="{{ url('view-resume/temp-3') }}" target="_blank">
                                    <figure>
                                        <figcaption class="text-center mb-3">Template 3</figcaption>
                                        <img src="{{ asset('resumes/template-3.png') }}" alt="" class="w-100">
                                    </figure>
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('styles')
    <style type="text/css">
        /* existing resume */
        .searchList li .jobimg {
            width: 100px;
        }

        .searchList li .jobimg img{
            /* max-width: 100%; */
        }


        /* resumes templates */
        /* .cv-template figure{
            height: 320px;
        }
        .cv-template figure img{
            object-fit: cover;
            height: 300px
        } */
        .cv-template figcaption{
            color: #000;
            font-size: 16px;
        }
    </style>
@endpush
@push('scripts')
@include('includes.immediate_available_btn')
@endpush