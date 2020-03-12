<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>UMS
                        <small>teacher</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-blue-sharp"></i>
                                    <span class="caption-subject font-blue-sharp bold uppercase">UMS</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" id='autoSearch' @input="search()" autocomplete="off" placeholder="Search with student id....">
                                        <div class="autocomplete-items">
                                            <div v-for="student in students" :key="student.student_id" @click.prevent="viewStudent(student.student_id)">{{student.student_id}} | {{student.name}}</div>
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn blue uppercase bold" type="button">Search</button>
                                        </span>
                                    </div>
                                </div><br><br><br><br>
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab">Profile</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab">Grade By Semester</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab">Grades</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_4" data-toggle="tab">Change Password</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">
                                         
                                        <table style="width:50%">
                                          <tr>
                                            <th>Student Name:</th>
                                            <td>{{student.StudentName}}</td>
                                          </tr>
                                           <tr>
                                            <th>Student ID:</th>
                                            <td>{{student.StudentId}}</td>
                                          </tr>
                                           <tr>
                                            <th>Credits Completed:</th>
                                            <td>{{student.CreditsComplete}}</td>
                                          </tr>
                                           <tr>
                                            <th>Course Completed:</th>
                                            <td>{{student.CourseComplete}}</td>
                                          </tr>
                                           <tr>
                                            <th>CGPA:</th>
                                            <td>{{student.CGPA}}</td>
                                          </tr>
                                        </table>
                                                                           


                                        </div>
                                        <!-- END PERSONAL INFO TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_2">

                                            

                                        <table v-for = "semester in student.Semester_details" :key="semester.id" class="table table-striped table-bordered ">
                                          
                                           <tr> <th>*** {{semester.Semester_Name}}</th></tr>
                                           <tr> </tr>
                                                 <td>
                                                   <th style="text-align: center">Class ID</th> 
                                                  <tr v-for = "courseId in semester.Course_Id" :key="courseId.id" style="text-align: center">
                                                       {{courseId}}  
                                                  </tr>
                                                  </td>

                                                     <td>
                                                        <th>Course Name</th> 
                                                        <tr v-for = "courseName in semester.Course_Name" :key="courseName.id" >
                                                            {{courseName}}
                                                        </tr>
                                                     </td>

                                                 <td>
                                                    <th>Course Section</th> 
                                                  <tr v-for = "courseSecion in semester.Course_Secion" :key="courseSecion.id" >
                                                       {{courseSecion}}  
                                                  </tr>
                                                  </td>

                                                     <td>
                                                        <th>Course Credit</th> 
                                                        <tr v-for = "courseCredit in semester.Course_Credit" :key="courseCredit.id" >
                                                            {{courseCredit}}
                                                        </tr>
                                                     </td>

                                                    <td>
                                                    <th>Grade</th> 
                                                  <tr v-for = "finalGrade in semester.Final_Grade" :key="finalGrade.id" >
                                                       {{finalGrade}}  
                                                  </tr>
                                                  </td>
                                           <tr></tr>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Semester GPA : {{semester.Semester_GPA}}</td>
                                            <td> CGPA : {{semester.Semester_CGPA}}</td>
                                        </tr>

                                         
                                        </table>





                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_3">
                                            
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_4">
                                            
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</template>
<style>
#autoSearch{
    background-color: #f1f1f1;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  width: 83.5%;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>



<script>
import { Validator } from 'vee-validate';
import axios from 'axios';


    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                user: '',
                students: [],
                student: ''
            }
        },
        created(){
            
        },
        methods:{
            search(){
                var id= $('#autoSearch').val();
                //console.log(id.length);
                if (id.length >= 3) {
                    fetch(`api/teachers.searchStudent/${id}`)
                    .then(res => res.json())
                    .then(res => {
                        //console.log(res);
                        this.students = res;
                    })
                    .catch(err => console.log(err));
                }else{
                    this.students = [];
                }
                
            },
            viewStudent(id){
                this.students = [];
                //console.log(id);
                fetch(`api/teachers.searchStudentDetails/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res[0]);
                    this.student = res[0];
                })
                .catch(err => console.log(err));

               
            },
        }
    }
</script>
