<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Company Details
                        <small>student</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <!-- BEGIN GENERAL PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-blue-sharp"></i>
                                    <span class="caption-subject font-blue-sharp bold uppercase">Company</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="alert alert-danger" v-if="student.semester_id == 0">
                                    You <strong> did not applied</strong> for internship.
                                </div>
                                <div class="alert alert-warning" v-if="student.semester_id != 0 && student.token_no != 'expired'">
                                    You have to <strong>add</strong> internship in your portal account. After admin's approval of
                                     your enrollment you will get a pdf in your home please take it to vues to complete enrollment.
                                    <br><br>
                                    <strong>You can Search to see verified existing companies:</strong>
                                    <br><br>

                                    <div class="input-group" style="width:50%">
                                        <input type="text" class="form-control" name="search" id='autoSearch' @input="search()" autocomplete="off" placeholder="Search with Company name or website....">
                                        <div id="autocomplete-items">
                                            <div v-for="company in companies" :key="company.company_id" data-toggle="modal" href="#companyDetalis" @click.prevent="viewCompany(company.company_id)">{{company.company_name}} | {{company.company_address}} | {{company.company_website}}</div>
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn blue uppercase bold" type="button">Search</button>
                                        </span>
                                    </div>
                                </div>

                                <div v-if="student.internship_status == 1 && student.token_no == 'expired'">
                                    <div class="alert alert-success" v-if="upC">
                                        <strong>Company Details</strong><br><br> 
                                        
                                        <table border="0">
                                            <tr><td><strong>Name  </strong> </td><td>: {{c.company_name}}</td></tr>
                                            <tr><td><strong>Type  </strong> </td><td>: {{c.company_type}}</td></tr>
                                            <tr><td><strong>Address </strong> </td><td>: {{c.company_address}}</td></tr>
                                            <tr><td><strong>Mobile No </strong> </td><td>: +880 {{c.company_contact}}</td></tr>
                                            <tr><td><strong>Website  </strong> </td><td>: {{c.company_website}}</td></tr>
                                            <tr>
                                                <td><strong>Status  </strong> </td>
                                                <td>: 
                                                    <span class="label label-sm label-warning" v-if=" c.verified == 0"> Pending </span>
                                                    <span class="label label-sm label-success" v-if=" c.verified == 1"> Verified </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><br>
                                                    <button class="btn blue" v-if="reqC == false" data-toggle="modal" href="#basic" @click.prevent="reqForChange()"> Request for change </button>
                                                    <button class="btn blue" v-if="reqC" disabled> You already requested for change </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="alert alert-warning" v-if="upC == false">
                                        <strong>Please add company details :</strong><br><br> 
                                        <strong>You can select from existing companies:</strong>
                                        <br><br>

                                        <div class="input-group" style="width:50%">
                                            <input type="text" class="form-control" name="search" id='autoSearch' @input="search()" autocomplete="off" placeholder="Search with Company name or website....">
                                            <div id="autocomplete-items">
                                                <div v-for="company in companies" :key="company.company_id" data-toggle="modal" href="#companyDetalis" @click.prevent="viewCompany(company.company_id)">{{company.company_name}} | {{company.company_address}} | {{company.company_website}}</div>
                                            </div>
                                            <span class="input-group-btn">
                                                <button class="btn blue uppercase bold" type="button">Search</button>
                                            </span>
                                        </div>

                                        <br><br><br><br> <strong>If you can not find your company add your company details :</strong> 
                                        <a class="btn green" data-toggle="modal" href="#basic" @click.prevent="clearForm()"> Add Company details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
            
        </div>

        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Company details</h4>
                    </div>
                    <div class="modal-body">  
                        <form  @submit.prevent="addCompany()" id="form_sample_2" class="form-horizontal" >
                            <div class="form-group">
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_name') }">
                                    <label class="control-label col-md-3">Company Name
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" v-model="company.company_name" v-validate="'required'" name="company_name" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_name')" ></i>
                                            <span v-show="errors.has('company_name')" class="required">{{ errors.first('company_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_type') }">
                                    <label class="control-label col-md-3">Company Type
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" v-model="company.company_type" v-validate="'required|alpha_spaces'" name="company_type" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_type')" ></i>
                                            <span v-show="errors.has('company_type')" class="required">{{ errors.first('company_type') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_address') }">
                                    <label class="control-label col-md-3">Address
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" v-model="company.company_address" v-validate="'required'"  name="company_address" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_address')" ></i>
                                            <span v-show="errors.has('company_address')" class="required">{{ errors.first('company_address') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_contact') }">
                                    <label class="control-label col-md-3">Mobile No
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" v-model="company.company_contact" v-validate="'required|numeric'"  name="company_contact" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_contact')" ></i>
                                            <span v-show="errors.has('company_contact')" class="required">{{ errors.first('company_contact') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_website') }">
                                    <label class="control-label col-md-3">Website
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" v-model="company.company_website" v-validate="'required|url'" name="company_website" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_website')" ></i>
                                            <span v-show="errors.has('company_website')" class="required">{{ errors.first('company_website') }}</span>    
                                        </div>
                                        <span class="help-block"> e.g: http://www.demo.com or http://demo.com </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-12" >
                                        <button type="submit" v-if="add" class="btn green">Submit</button>
                                        <button type="button" v-if="edit" class="btn green" @click.prevent="addReqForChange()">Submit</button>
                                        <button type="reset" v-if="add"  class="btn default">Cancel</button>
                                        <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="companyDetalis" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Company Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success">
                            <table class="table table-bordered order-column">
                                <tbody>
                                    <tr><td align="left"><strong>Company Name: </strong> </td><td align="left"> {{companyDetails.company_name}}</td></tr>
                                    <tr><td align="left"><strong>Company Type: </strong> </td><td align="left"> {{companyDetails.company_type}}</td></tr>
                                    <tr><td align="left"><strong>Company address: </strong> </td><td align="left"> {{companyDetails.company_address}}</td></tr>
                                    <tr><td align="left"><strong>Company contact: </strong> </td><td align="left"> {{companyDetails.company_contact}}</td></tr>
                                    <tr><td align="left"><strong>Company website: </strong> </td><td align="left"> {{companyDetails.company_website}}</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div align="right">
                            <button v-if="student.token_no == 'expired'" @click.prevent="addExistCompany(companyDetails.company_id)" class="btn green" id="addCompany">Add Company</button>
                            <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</template>
<style>
#autoSearch{
    background-color: #f1f1f1;
}

#autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  width: 81.5%;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

#autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
#autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
#autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

<script>
import { Validator } from 'vee-validate';

    export default {
        mounted() {
            console.log('Component mounted.');
        },
        data() {
            return {
                student_id: $('#user_id').val(),
                upC: false,
                c: '',
                companies: [],
                companyDetails: '',
                company: {
                    student_id: $('#user_id').val(),
                    company_id: '',
                    company_name: '',
                    company_type: '',
                    company_contact: '',
                    company_address: '',
                    company_website: ''
                },
                existCompany: {
                    student_id: $('#user_id').val(),
                    company_id: ''
                },
                student: '',
                add: true,
                edit: true,
                reqC: true
            }
        },
        created(){
            
            this.loadCompany(this.student_id);
            this.viewStudent(this.student_id);
            this.loadReqForChange(this.student_id);
        },
        methods: {
            viewStudent(id){
                //console.log(id)
                fetch(`api/student.profile/${id}`)
                .then(res => res.json())
                .then(res => {
                    this.student = res;
                })
                .catch(err => console.log(err));
            },
            loadReqForChange(id){
                //console.log(id)
                fetch(`api/student.loadReqForChange/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res)

                    if (res.valid == false) {
                        this.reqC = true;
                    }else{
                        this.reqC = false;
                    }
                })
                .catch(err => console.log(err));
            },
            search(){
                var name= $('#autoSearch').val();
                //console.log(id.length);
                if (name.length >= 3) {
                    fetch(`api/student.searchCompany/${name}`)
                    .then(res => res.json())
                    .then(res => {
                        //console.log(res);
                        this.companies = res;
                    })
                    .catch(err => console.log(err));
                }else{
                    this.companies = [];
                }
                
            },
            viewCompany(id){
                this.companies = [];
                //console.log(id);
                fetch(`api/student.searchCompanyDetails/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.companyDetails = res;

                })
                .catch(err => console.log(err));
            },
            loadCompanies(){
                fetch('api/companies.studentLoad')
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    //this.companies = res;
                })
                .catch(err => console.log(err));
            },
            loadCompany(id){
                fetch(`api/companies/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    if (res.valid == false || res[0].company_name == null) {
                        this.upC = false;
                    }else{
                        this.upC = true;
                        this.c = res[0];
                    }
                })
                .catch(err => console.log(err));
            },
            reqForChange(){
                this.add = false;
                this.edit = true;
                this.company.company_id = this.c.company_id;
                this.company.company_name = this.c.company_name;
                this.company.company_type = this.c.company_type;
                this.company.company_address = this.c.company_address;
                this.company.company_contact = this.c.company_contact;
                this.company.company_website = this.c.company_website;
                this.$validator.reset();
            },
            addReqForChange(){
                this.validateBeforeSubmit();
                fetch('api/companies.addReqForChange',{
                    method: 'post',
                    body: JSON.stringify(this.company),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    swal({
                        icon: "success",
                        title: "Success!",
                        text: "Company details update request successfully added.",
                        type: "success"
                    }).then(function() {
                        window.location = "redirectURL";
                    });
                })
                .catch(err => console.log(err))
            },
            clearForm(){
                this.add = true;
                this.edit = false;
                this.company.company_name = '';
                this.company.company_type = '';
                this.company.company_address = '';
                this.company.company_contact = '';
                this.company.company_website = '';
                this.$validator.reset();
            },
            addCompany(){
                this.validateBeforeSubmit();
                fetch('api/companies',{
                    method: 'post',
                    body: JSON.stringify(this.company),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    swal({
                        icon: "success",
                        title: "Success!",
                        text: "Company details added.",
                        type: "success"
                    }).then(function() {
                        window.location = "redirectURL";
                    });
                })
                .catch(err => console.log(err))
            },
            addExistCompany(id){
                this.existCompany.company_id = id;

                fetch('api/companies.addExistCompany',{
                    method: 'post',
                    body: JSON.stringify(this.existCompany),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => {
                    swal({
                        icon: "success",
                        title: "Success!",
                        text: "Company details added.",
                        type: "success"
                    }).then(function() {
                        window.location = "redirectURL";
                    });
                })
                .catch(err => console.log(err))
                
            },
            validateBeforeSubmit(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        // eslint-disable-next-line
                        //alert('Form Submitted!');
                        console.log('if');
                        return ;
                    }
                    else{
                        console.log('else');
                        return ;
                    }
                });
            }
        }
    }
</script>
