<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Student Registration
                        <small>admin</small>
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
                                <span class="caption-subject font-blue-sharp bold uppercase">Registration Form</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="alert alert-danger" v-if="showError">
                                <ul>
                                    <li v-if="showError1">{{ errorId }}</li>
                                    <li v-if="showError2">{{ errorEmail }}</li>
                                </ul>
                            </div>
                            <!-- BEGIN FORM-->
                            <form action="" @submit.prevent="reg"  method="post" id="form_sample_4" class="form-horizontal" >
                                <!-- <input type="hidden" name="_token" :value="csrf">   -->
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Name
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="name" data-required="1" class="form-control" v-model="name"/> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">ID
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="id" data-required="1" class="form-control" v-model="id"/> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Department
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="department" data-required="1" class="form-control" v-model="department"/> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Credit left after current semester
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="number" name="credit" min="1" max="12" data-required="1" class="form-control" v-model="credit"/> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input name="email" type="text" class="form-control" v-model="email"/> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Mobile No.
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input name="mobile" type="text" class="form-control" v-model="mobile"/> </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-6 col-md-9">
                                            <input type="submit" class="btn green">
                                            <button type="reset" class="btn grey-salsa btn-outline">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
                <!-- END GENERAL PORTLET-->
            </div>
        </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</template>

<script>
    import axios from 'axios';

    export default {
        data(){
            return {
                showError: false,
                showError1: false,
                showError2: false,
                errorId: '',
                errorEmail: '',
                name: '',
                id: '',
                department: '',
                credit: '',
                email: '',
                mobile: '',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            reg(){
                axios.post('/adminRegistrationStore',{
                    name: this.name,
                    id: this.id,
                    department: this.department,
                    credit: this.credit,
                    email: this.email,
                    mobile: this.mobile
                })
                .then(response => alert("success"))
                .catch(error => {
                    console.log(JSON.stringify(error.response.data.errors));
                    this.showError = true;
                    if(error.response.data.errors.id){
                        this.showError1 = true;
                        this.errorId = error.response.data.errors.id[0];
                    }else{
                        this.showError1 = false;
                        this.errorId = '';
                    }
                    
                    if (error.response.data.errors.email){
                        this.showError2 = true;
                        this.errorEmail = error.response.data.errors.email[0];
                    }else{
                        this.showError2 = false;
                        this.errorEmail = '';
                    }
                })
            }
        }
        
    }
</script>
