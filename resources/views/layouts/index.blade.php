<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>CS Intern</title>
        <!--
        CSS
        ============================================= -->
        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/indexPage/css/bootstrap.css">
        <link rel="stylesheet" href="assets/indexPage/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/indexPage/css/main.css">
        
    </head>
    <body>	
        <nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <table>
                        <tr>
                            <td>
                                <img src="/assets/indexPage/img/aiub_logo.png" alt="American International University-Bangladesh (AIUB)" height="100" width="100" style="margin-right: 10px;">
                            </td>
                            <td>
                                <h5 style="color: #004ea8;">American  International University<br>-Bangladesh</h5>
                                <br>
                                <h6 style="color: black;">where leaders are created</h6>
                            </td>
                        </tr>
                    </table>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Important Links
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="http://www.aiub.edu/" target="_blank">AIUB Home</a>
                                <a class="dropdown-item" href="https://portal.aiub.edu/" target="_blank">AIUB Portal</a>
                                <a class="dropdown-item" href="https://fsit.aiub.edu/" target="_blank">AIUB FSIT</a>
                                <a class="dropdown-item" href="https://research.cs.aiub.edu/" target="_blank">AIUB CS Research</a>
                            </div>
                          </li>
                        <li><a href="{{route('login')}}" class="nav-link">Login / Register</a></li>
                    </ul>
                </div>
            </div>
        </nav>

          @yield('content')
            
        <!-- start footer Area -->		
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-footer-widget">
                            <table>
                                <tr>
                                    <td>
                                        <img src="/assets/indexPage/img/aiub_logo.png" alt="American International University-Bangladesh (AIUB)" height="100" width="100" style="margin-right: 10px;">
                                    </td>
                                    <td>
                                        <br>
                                        <h6>American  International University<br>-Bangladesh</h6>
                                        
                                        <p>
                                            408/1, Kuratoli, Khilkhet, Dhaka 1229, Bangladesh
                                            <br>
                                            info@aiub.edu
                                        </p>
                                    </td>
                                </tr>
                            </table>
                                
                        </div>
                    </div>						
                    <div class="col-md-6">
                        <div class="single-footer-widget">
                            <br>
                            <h6>Developer's Information</h6>
                            <a  href="{{route('developerProfile')}}">Please click here</a>
                        </div>
                    </div>							
                </div>
            </div>
        </footer>	
        <!-- End footer Area -->
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/indexPage/js/vendor/bootstrap.min.js"></script>
        <script src="assets/indexPage/js/superfish.min.js"></script>	
        <script src="assets/indexPage/js/jquery.magnific-popup.min.js"></script>	
        <script src="assets/indexPage/js/owl.carousel.min.js"></script>	
        <script src="assets/indexPage/js/jquery.counterup.min.js"></script>
        <script src="assets/indexPage/js/main.js"></script>	
        

        @yield('script')
        <script type="text/javascript">
            function load(n, s, c){
                $('#name').text(n);
                $('#subject').text(s);
                $('#content').text(c);
            }
        </script>
    </body>
</html>



