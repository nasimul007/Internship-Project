@extends('layouts.index')


@section('content')
    <!-- Start feedback Area -->
    <section class="feedback-area aboutus-feedback" id="feedback">
        <div class="container">	
            <br>
            <div class="row">
                <div class="col-lg-6 feedback-right" >
                    <h3> <strong> Student Instructions </strong> </h3>
                    <br>
                    <div class="active-review-carusel" >
                        <div class="single-feedback-carusel">
                            <div class="title d-flex flex-row">
                                <h4 class="pb-10">Registration</h4>
                                                                    
                            </div>
                            
                                <p><i class="fa fa-circle"></i>  Student's will have to register giving valid information.</p>
                                <p><i class="fa fa-circle"></i>  Student will get a verification email with and ID and Password.</p>
                                <p><i class="fa fa-circle"></i>  Student can log in to their account with That ID and password.</p>
                                <p><i class="fa fa-circle"></i>  Student can Proced to apply for intern after completing these steps.</p>
                        
                        </div>
                        <div class="single-feedback-carusel">
                            <div class="title d-flex flex-row">
                                <h4 class="pb-10">Apply For Intern</h4>
                                                                    
                            </div>
                            
                                <p><i class="fa fa-circle"></i>  Students will apply for intern in the semester openend by admin</p>
                                <p><i class="fa fa-circle"></i>  Students must consult with admin if more then 6 credit<br>(excluding Thesis and Intern) is left during Intern semester.</p>
                                <p><i class="fa fa-circle"></i>  Admin will assign students to a batches after they have registered.</p>
                                <p><i class="fa fa-circle"></i>  Student can Proced to apply for intern after completing these steps</p>
                                <p><i class="fa fa-circle"></i>  Student can start internship course after completing these steps.</p>
                        </div>
                        <div class="single-feedback-carusel">
                            <div class="title d-flex flex-row">
                                <h4 class="pb-10">General Rules</h4>
                                                                    
                            </div>
                                <p><i class="fa fa-circle"></i>  If a student cancle Intership Course during registration, will have to contact the admin to re register.</p>
                                <p><i class="fa fa-circle"></i>  Changing the password provided by admin is adviced.</p>
                                <p><i class="fa fa-circle"></i>  Students can contact admin after registration if they don't get verification email after 48 hours .</p>
                                <p><i class="fa fa-circle"></i>  Providin wrong information is strictly prohibited.</p>
                        </div>																
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <h3 style="margin-left:5% "> <strong> Notices </strong> </h3>
                
                    <div class="single-widget recent-posts-widget" style="border-left: 1px solid #333;">
                        <div class="blog-list " style="overflow: auto ; height: 300px;">

                            @if($notices != null)

                            @foreach ($notices as $notice)
                            <div class="single-recent-post d-flex flex-row" >
                                
                                <div class="card" style="width: 95%;">
                                    <div class="card-body">
                                        <div class="recent-details">
                                        <a href="#" onclick="load('{{$notice->name}}','{{$notice->subject}}','{{$notice->content}}')" data-toggle="modal" data-target="#exampleModal">
                                                <h4>
                                                    {{$notice->subject}}
                                                </h4>
                                            </a>
                                            <p>
                                                {{$notice->date}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            @endforeach

                            @endif
                                                                                                                                                                                
                        </div>                              
                    </div>
                </div> 
            </div>
        </div>	
    </section>
    <!-- End feedback Area -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p>
                        <b style="color:black;">Teacher Name : </b><div id="name"></div>
                    </p>
                    <p>
                        <b style="color:black;">Subject :</b><div id="subject"></div>
                    </p>
                    <p>
                        <b style="color:black;">Content : </b>
                        <div id="content"></div>
                    </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

 
@section('script')
    <script type="text/javascript">
        function load(n, s, c){
            $('#name').text(n);
            $('#subject').text(s);
            $('#content').text(c);
        }
    </script>
@endsection

