<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Token
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
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="alert alert-success" >
                                            <strong>Student Details : </strong>
                                            <a v-if="stuEx"  class="btn red btn-outline" @click.prevent="expireToken(student.student_id)">Expire Token </a>
                                            <br><br> 
                                            
                                            <table style="width:40%;" border="1" v-if="stuEx">
                                                <tr><td align="left"><strong>Name  </strong> </td><td align="left"> {{student.name}}</td></tr>
                                                <tr><td align="left"><strong>Id  </strong> </td><td align="left"> {{student.student_id}}</td></tr>
                                                <tr><td align="left"><strong>Department  </strong> </td><td align="left"> {{student.department}}</td></tr>
                                                <tr><td align="left"><strong>Batch Id  </strong> </td><td align="left"> {{student.batch_id}}</td></tr>
                                                <tr><td align="left"><strong>Token No.  </strong> </td><td align="left"> {{student.token_no}}</td></tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
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
                students: [],
                student: '',
                stuEx: false
            }
        },
        created(){
            
        },
        methods:{
            search(){
                var id= $('#autoSearch').val();
                this.stuEx = false;

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
                fetch(`api/teachers.searchStudentToken/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);

                    this.stuEx = false;
                    if (res != null) {
                        this.student = res;
                        this.stuEx = true;
                    }
                })
                .catch(err => console.log(err));
            },
            expireToken(id){
                fetch(`api/teachers.expireToken/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    if (res != null) {
                        this.viewStudent(id);

                        swal('Success!', "Student's token status updated.", 'success');
                    }
                })
                .catch(err => console.log(err));
            },
        }
    }
</script>
