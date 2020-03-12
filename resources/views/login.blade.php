@extends('layouts.l')

@section('title', 'Log in')

@section('content')
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <div class="row">
            <div class="col-sm-4 col-xs-12 text-center">
                <img src="/assets/global/aiub_logo_92x92.png" height="92">
            </div>

            <div class="col-sm-8 col-xs-12">
                <p >AMERICAN INTERNATIONAL UNIVERSITY-BANGLADESH</p>
                <small >- where leaders are created.</small>
            </div>
        </div>
        <form class="login-form">
            {{csrf_field()}}
            <div class="form-title">
                <br>
                <span class="form-title">Welcome.</span>
                <span class="form-subtitle">Please login.</span>
            </div>
            <div class="alert alert-danger display-hide" id="enter">
                <button class="close" data-close="alert"></button>
                <span> Enter any userId and password. </span>
            </div>
            <div class="alert alert-danger display-hide" id="missmatch">
                <button class="close" data-close="alert"></button>
                <span> UserId or password missmatch ! </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">User ID</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="User ID" name="userid" /> </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn green pull-right"> Login </button>
            </div>
            <div class="forget-password">
                <h4>Forgot your password ?</h4>
                <p> no worries, click
                    <a href="javascript:;" id="forget-password"> here </a> to reset your password. 
                </p>
            </div>
            <div class="create-account">
                <p>For Internship ? 
                    <a href="javascript:;" id="register-btn">Click to create an account </a>
                </p>
            </div>
        </form>
        <!-- END LOGIN FORM -->

        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form">
             
            <h3>Forget Password ?</h3>
            <p> Enter your Id below to reset your password. </p>
            <div class="form-group">
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="User Id" name="user_id" /> </div>
            </div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn grey-salsa btn-outline"> Back </button>
                <button type="submit" class="btn green pull-right"> Submit </button>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->

        <!-- BEGIN REGISTRATION FORM -->
        <form class="register-form">
            {{csrf_field()}}
            <h3> Sign Up </h3>
            <p> Enter your personal details below: </p>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                <div class="input-icon">
                    <i class="fa fa-font"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="name" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">ID</label>
                <div class="input-icon">
                    <i class="fa fa-indent"></i>
                    <input class="form-control placeholder-no-fix" type="tel" id="idCheck" placeholder="ID" pattern="[0-9]{2}-[0-9]{5}-[1-3]{1}" name="id" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Department</label>
                <div class="input-icon">
                    <i class="fa fa-graduation-cap"></i>
                    {{-- <input class="form-control placeholder-no-fix" type="text" placeholder="Department" name="department" /> --}}
                    <select name="department" class="form-control placeholder-no-fix" placeholder="Department">
                        <option value="">Select Department</option>
                        <option value="CSE">CSE</option>
                        <option value="CSSE">CSSE</option>
                        <option value="SE">SE</option>
                        <option value="CS">CS</option>
                        <option value="CIE">CIE</option>
                    </select>
                </div>
            </div>
            {{-- <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Credit Left After Current Semester</label>
                <div class="input-icon">
                    <i class="fa fa-book"></i>
                    <input class="form-control placeholder-no-fix" type="text" min="3" max="12" placeholder="Credit Left After Current Semester" name="credit" />
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Subject Left After Current Semester</label>
                <div class="input-icon">
                    <i class="fa fa-book"></i>
                    <input class="form-control placeholder-no-fix" type="text" min="1" max="4" placeholder="Subject Left After Current Semester" name="subject" />
                </div>
            </div>  --}}
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="text" id="emailCheck" placeholder="Email" name="email" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Mobile</label>

                <div class="input-group input-large margin-top-10">
                    <span class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </span>
                    <span class="input-group-addon">
                        +880
                    </span>
                    <input class="form-control" style="width:90%;" type="text" placeholder="Mobile Number" name="mobile" />
                </div>
            </div>
            <div class="form-actions">
                <button id="register-back-btn" type="button" class="btn grey-salsa btn-outline"> Back </button>
                <button type="submit" id="register-submit-btn" class="btn green pull-right"> Sign Up </button>
            </div>
        </form>
        <!-- END REGISTRATION FORM -->
    </div>
    <!-- END LOGIN -->
@endsection

@section('script')

<script type="text/javascript">


</script>

@endsection
