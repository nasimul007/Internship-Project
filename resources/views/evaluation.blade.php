@extends('layouts.l')

@section('title', 'Evaluation')

@section('content')
<style type="text/css">
    .help-block {
        color: red;
    }
</style>
    <!-- BEGIN LOGIN -->
    <div class="content" style="width: 70%;">
        <!-- BEGIN LOGIN FORM -->
        <h4>Student Details</h4>

        @if($student != null)
            <p>Name : <strong>{{$student->name}}</strong> </p>
            <p>Id : <strong>{{$student->student_id}}</strong> </p>
            <form id="evaluation_form">
                    {{csrf_field()}}
                    
                    @if($student != null)
                        <input type="hidden" name="student_id" value="{{$student->student_id}}">
                    @endif
                    
                    <h2 style="color: blue; text-align: center;"><u><strong>Evaluation Form</strong> </u> </h2>
        
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px solid #333;">
                            <p class="form-group">
                                1.<strong > Evaluate the Intern's development and progress in technical skills such as drafting, sketching, field reports, delineation, etc.</strong> 
                                <br><br>
                                <input type="radio" name="ans1" value="distinction" > Distinction 
                                <input type="radio" name="ans1" value="excellent" class="input-icon"> Excellent 
                                <input type="radio" name="ans1" value="good"> Good 
                                <input type="radio" name="ans1" value="deficient"> Deficient 
                                <input type="radio" name="ans1" value="failing"> Failing
                            </p>
                            <p class="form-group">
                                2.<strong>Intern's verbal communications expressing his thoughts and understanding thoughts of others.</strong> 
                                <br><br>
                                <input type="radio" name="ans2" value="distinction"> Distinction 
                                <input type="radio" name="ans2" value="excellent"> Excellent 
                                <input type="radio" name="ans2" value="good"> Good 
                                <input type="radio" name="ans2" value="deficient"> Deficient 
                                <input type="radio" name="ans2" value="failing"> Failing 
                            </p>
                            <p class="form-group">
                                3. <strong>Neatness of Intern's work and efforts for the office.</strong> 
                                <br><br>
                                <input type="radio" name="ans3" value="distinction"> Distinction 
                                <input type="radio" name="ans3" value="excellent"> Excellent 
                                <input type="radio" name="ans3" value="good"> Good 
                                <input type="radio" name="ans3" value="deficient"> Deficient 
                                <input type="radio" name="ans3" value="failing"> Failing 
                            </p>
                            <p class="form-group">
                                4. <strong>Thoughtness of Intern's work and efforts for the office.</strong> 
                                <br><br>
                                <input type="radio" name="ans4" value="distinction"> Distinction 
                                <input type="radio" name="ans4" value="excellent"> Excellent 
                                <input type="radio" name="ans4" value="good"> Good 
                                <input type="radio" name="ans4" value="deficient"> Deficient 
                                <input type="radio" name="ans4" value="failing"> Failing 
                            </p>
                            <p class="form-group">
                                5. <strong>Intern's willingness in performing assigned tasks.</strong> 
                                <br><br>
                                <input type="radio" name="ans5" value="distinction"> Distinction 
                                <input type="radio" name="ans5" value="excellent"> Excellent 
                                <input type="radio" name="ans5" value="good"> Good 
                                <input type="radio" name="ans5" value="deficient"> Deficient 
                                <input type="radio" name="ans5" value="failing"> Failing 
                            </p>
                            
                        </div>
                        <div class="col-md-6" >
                            <p class="form-group">
                                6. <strong>Intern's general attitude to the entire employment in the office.</strong> 
                                <br><br>
                                <input type="radio" name="ans6" value="distinction"> Distinction 
                                <input type="radio" name="ans6" value="excellent"> Excellent 
                                <input type="radio" name="ans6" value="good"> Good 
                                <input type="radio" name="ans6" value="deficient"> Deficient 
                                <input type="radio" name="ans6" value="failing"> Failing 
                            </p>
                            <p class="form-group">
                                7. <strong>Ability of intern to take on assigned responsibilities to the best of intern's capability.</strong> 
                                <br><br>
                                <input type="radio" name="ans7" value="distinction"> Distinction 
                                <input type="radio" name="ans7" value="excellent"> Excellent 
                                <input type="radio" name="ans7" value="good"> Good 
                                <input type="radio" name="ans7" value="deficient"> Deficient 
                                <input type="radio" name="ans7" value="failing"> Failing 
                            </p>
                            <p class="form-group">
                                8. <strong>Intern's professional curiosity in asking questions about officce techniques and procedures.</strong> 
                                <br><br>
                                <input type="radio" name="ans8" value="distinction"> Distinction 
                                <input type="radio" name="ans8" value="excellent"> Excellent 
                                <input type="radio" name="ans8" value="good"> Good 
                                <input type="radio" name="ans8" value="deficient"> Deficient 
                                <input type="radio" name="ans8" value="failing"> Failing 
                            </p>
                            <p class="form-group">
                                9. <strong>Was intern a help to the office?</strong> 
                                <br><br>
                                <input type="radio" name="ans9" value="distinction"> Distinction 
                                <input type="radio" name="ans9" value="excellent"> Excellent 
                                <input type="radio" name="ans9" value="good"> Good 
                                <input type="radio" name="ans9" value="deficient"> Deficient 
                                <input type="radio" name="ans9" value="failing"> Failing 
                            </p>
                            <p class="form-group">
                                10. <strong>Evaluation of intern's overall performance.</strong> 
                                <br><br>
                                <input type="radio" name="ans10" value="distinction"> Distinction 
                                <input type="radio" name="ans10" value="excellent"> Excellent 
                                <input type="radio" name="ans10" value="good"> Good 
                                <input type="radio" name="ans10" value="deficient"> Deficient 
                                <input type="radio" name="ans10" value="failing"> Failing 
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <strong>****Comment on overall performance.</strong><br>
                        <textarea rows="4" cols="50"  name="comment" form="evaluation_form" id="comment">Write Comment here</textarea>
                    </div>
        
                    
                    <div class="form-actions">
                        {{-- <button type="submit" class="btn green pull-right" > Submit </button> --}}
        
                        <button type="submit" class="btn green pull-right" > Submit </button>
                    </div>
                </form>
        @else 
            <script type="text/javascript">
                alert('Not a valid link');
                window.location.href = '/';
            </script>
        @endif
        
        
    </div>
    <!-- END LOGIN -->
@endsection
@section('script')
    <script type="text/javascript">
        $('#comment').on("click", function(e) {

            $('#comment').val('');
        });
    </script>
@endsection