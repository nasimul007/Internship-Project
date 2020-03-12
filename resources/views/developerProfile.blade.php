@extends('layouts.index')


@section('content')

    <!-- Start service Area -->
    <section class="service-area" id="service">
        <div class="container">
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12 pb-30 header-text text-center">
                    <h1 class="mb-10">Development Team</h1>
                </div> 
                <div class="col-lg-3">
                    <div class="single-service">
                        <div class="thumb">
                            <img src="/assets/indexPage/img/sir.png" alt="">									
                        </div>
                        <h4 style="text-align: center;">ABHIJIT BHOWMIK</h4>
                        <p style="text-align: center;">
                         Project Manager <br>
                            Senior Assistant Professor and Special Assistant, Office of Student Affairs( CS, FST, AIUB )
                        </p>
                    </div>
                </div>
            </div>	
                <br>
            <div class="row justify-content-center">
                <div class="col-lg-3" style="margin-right: 5%;">
                    <div class="single-service">
                        <div class="thumb">
                            <img src="/assets/indexPage/img/sir.png" alt="">									
                        </div>
                        <h4 style="text-align: center;">ABHIJIT BHOWMIK</h4>
                        <p style="text-align: center;">
                         Project Manager <br>
                            Senior Assistant Professor and Special Assistant, Office of Student Affairs( CS, FST, AIUB )
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-service">
                        <div class="thumb">
                            <img src="/assets/indexPage/img/sir.png" alt="">									
                        </div>
                        <h4 style="text-align: center;">MD. AL AMIN</h4>
                        <p style="text-align: center;">
                            Project Architect <br>
                            Lecturer ( CS, FST, AIUB )
                        </p>
                    </div>
                </div>
            </div>

            <br>					
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="single-service">
                        <div class="thumb" >
                            <img src="/assets/indexPage/img/nh.jpg" alt="">									
                        </div>
                        <h4 style="text-align: center;">NASIMUL HASAN</h4>
                        <p style="text-align: center;">
                            Full Stack Developer <br>
                            nasimul.hasan.aiub@gmail.com
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-service">
                        <div class="thumb">
                            <img src="/assets/indexPage/img/mk.jpg" alt="">									
                        </div>
                        <h4 style="text-align: center;">M MONJIRUL KABIR</h4>
                        <p style="text-align: center;">
                            Full Stack Developer <br>
                            monjirul.kabir.aiub@gmail.com
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-service">
                        <div class="thumb">
                            <img src="/assets/indexPage/img/kh.jpg" alt="">									
                        </div>
                        <h4 style="text-align: center;">MD KHALID HASAN TAHMID</h4>
                        <p style="text-align: center;">
                            Full Stack Developer  <br>
                            khaldhassantahmid@gmail.com
                        </p>
                    </div>
                </div>										
            </div>
        </div>	
    </section>
    <!-- End service Area -->
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

