@extends('layouts.l')

@section('title', 'Reset Password')

@section('content')
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form id="newPassForm">
            {{csrf_field()}}
            <input type="hidden" name="token" value="<?=$_GET['token']?>">
            <div class="form-title">
                <span class="form-title">Welcome. </span>
                <span class="form-subtitle">Please enter your new password.</span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">New Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" id="newPass" name="newPass" /> </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Re-type New Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type New Password" name="newRePass" /> </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn green pull-right"> Save changes </button>
            </div>
        </form>
    </div>
    <!-- END LOGIN -->
@endsection
