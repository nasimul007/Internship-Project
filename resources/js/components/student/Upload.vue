<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Upload
                        <small>student</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12" >
                    <!-- BEGIN WELLS PORTLET-->
                    <div>
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Uploads</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="alert alert-danger" v-if="student.semester_id == 0">
                                    You <strong> did not applied</strong> for internship.
                                </div>
                                <div class="alert alert-warning" v-if="student.semester_id != 0 && student.token_no != 'expired'">
                                    You have to <strong>add</strong> internship in your portal account. After admin's approval of
                                     your enrollment you will get a pdf in your home <strong>please take it to vues to complete enrollment</strong>.
                                </div>

                                <div v-if="student.internship_status == 1 && student.token_no == 'expired'">
                                    <h4 class="block">CV</h4>
                                        <form @submit.prevent="uploadCv()" v-if="student.internship_status == 1 && student.token_no == 'expired' && upCv == false" target="blank"  id="form_sample_1" class="form-horizontal" >
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">CV (PDF)
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="file" name="file" class="form-control" id="file" ref="file"  v-on:change="handleFileUpload()" /> </div>
                                                            <span class="help-block">Select your cv</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        <button type="reset" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="alert alert-success" style="margin-top:1%;" v-if="upCv">
                                            <strong style="margin-right:1%;">Success! You have uploaded your cv</strong> File name: {{viewFiles.cv_title}} 
                                            <button class="btn purple btn-outline" @click.prevent="downloadCv(student.student_id)" style="margin-left:1%;"> Download</button>
                                            <button class="btn red btn-outline" @click.prevent="deleteCv(student.student_id)" style="margin-left:1%;"> Delete</button>
                                        </div>
                                    <h4 class="block">Appointment Letter</h4>
                                        <div class="alert alert-danger" v-if="upCv == false">
                                            <strong>Error! Please upload your CV first</strong> </div>

                                        <form @submit.prevent="uploadAppointmentLetter()" v-if="upAl == false && upCv" id="form_sample_3" class="form-horizontal">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Appointment letter (PDF)
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="file" name="file" class="form-control" id="file2" ref="file2"  v-on:change="handleFileUpload2()" /> </div>
                                                            <span class="help-block">Select your appointment letter</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        <button type="reset" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="alert alert-success" style="margin-top:1%;" v-if="upAl">
                                            <strong style="margin-right:1%;">Success! You have uploaded your Appointment Later</strong> File name: {{viewFiles.appointment_letter_title}} 
                                            <button class="btn purple btn-outline" @click.prevent="downloadAppointmentLetter(student.student_id)" style="margin-left:1%;"> Download</button>
                                            <button class="btn red btn-outline" @click.prevent="deleteAppointmentLetter(student.student_id)" style="margin-left:1%;"> Delete</button>
                                        </div>
                                    <h4 class="block">Book Report</h4>
                                    <div class="alert alert-danger" v-if="upAl == false || upAl && upSuper == false">
                                            <strong>Error! Please upload your Appointment Letter and Supervisor details first</strong> </div>

                                        <form @submit.prevent="uploadBookReport()" v-if="upBr == false && upAl && upSuper" id="form_sample_3" class="form-horizontal">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Book Report (PDF)
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="file" name="file" class="form-control" id="file3" ref="file3"  v-on:change="handleFileUpload3()" /> </div>
                                                            <span class="help-block">Select your book report</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        <button type="reset" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="alert alert-success" style="margin-top:1%;" v-if="upBr">
                                            <strong style="margin-right:1%;">Success! You have uploaded your book report</strong> File name: {{viewFiles.book_report_title}} 
                                                <button class="btn purple btn-outline" @click.prevent="downloadBookReport(student.student_id)" style="margin-left:1%;"> Download</button>
                                                <button class="btn red btn-outline" @click.prevent="deleteBookReport(student.student_id)" style="margin-left:1%;"> Delete</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END WELLS PORTLET-->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            const plugin = document.createElement("script");

            plugin.setAttribute(
            "src",
            "assets/pages/scripts/table-datatables-managed.min.js"
            );
                
            plugin.async = true;
            document.body.appendChild(plugin);
        },
        data() {
            return {
                student: {
                    name: '',
                    student_id: $('#user_id').val(),
                    department: '',
                    email: '',
                    credits_left: '',
                    mobileNo: '',
                    credits_left: '',
                    subjects_left: '',
                    batch_id: '',
                    internship_status: '',
                    registration_status: '',
                    registration_date: '',
                    enrollment_date: '',
                    semester_id: '',
                    token_no: ''
                },
                file: '',
                viewFiles: '',
                upBr: true,
                upAl: true,
                upCv: true,
                upSuper: true
            }
        },
        created(){
            console.log($('#user_id').val());
            this.student_id = $('#user_id').val();
            this.viewStudent(this.student_id);
            this.loadUploads(this.student_id);
            this.loadSupervisor(this.student_id);
        },
        methods: {
            viewStudent(id){
                console.log(id)
                fetch(`api/student.profile/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.student = res;
                })
                .catch(err => console.log(err));
            },
            loadUploads(id){
                fetch(`api/student.loadUploads/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res.valid);
                    this.viewFiles = res;

                    if (res.valid == false || res.cv_title == 'later') {
                        this.upCv = false;
                        this.upBr = false;
                        this.upAl = false;
                    }

                    if (res.book_report_title == 'later') {
                        this.upBr = false;
                    }

                    if (res.appointment_letter_title == 'later') {
                        this.upAl = false;
                    }
                })
                .catch(err => console.log(err));

                //console.log(this.upCv);
            },
            loadSupervisor(id){
                fetch(`api/supervisors/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log('super'+res);
                    if (res.valid == false) {
                        this.upSuper = false;
                    }
                })
                .catch(err => console.log(err));
            },
            uploadCv(){
                let formData = new FormData();
                console.log(this.file);

                formData.append('file', this.file);
                formData.append('student_id', this.student_id);

                axios.post('api/student.uploadCv',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    console.log(res);
                    location.reload();
                }).catch(error => {
                    console.log(error);
                })
            },
            downloadCv(id){
                console.log(id);
                window.open(`api/student.downloadCv/${$('#user_id').val()}`, '_blank');
            },
            deleteCv(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Once applied you can not change semester.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/teacher.deleteCv/${id}`,{
                            method: 'get'
                        })
                        .then(data => {
                            swal({
                                icon: "success",
                                title: "Success!",
                                text: "You have successfully applied for intern.",
                                type: "success"
                            }).then(function() {
                                window.location = "redirectURL";
                            });
                        })
                        .catch(err => console.log(err))
                    }
                });
            },
            uploadAppointmentLetter(){
                let formData = new FormData();
                console.log('first'+this.file);

                formData.append('file', this.file);
                formData.append('student_id', this.student_id);

                axios.post('api/student.uploadAppointmentLetter',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    console.log(res);
                    location.reload();
                }).catch(error => {
                    console.log(error);
                })
            },
            downloadAppointmentLetter(id){
                console.log(id);
                window.open(`api/student.downloadAppointmentLetter/${$('#user_id').val()}`, '_blank');
            },
            deleteAppointmentLetter(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Once applied you can not change semester.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/teacher.deleteAppointmentLetter/${id}`,{
                            method: 'get'
                        })
                        .then(data => {
                            swal({
                                icon: "success",
                                title: "Success!",
                                text: "You have successfully applied for intern.",
                                type: "success"
                            }).then(function() {
                                window.location = "redirectURL";
                            });
                        })
                        .catch(err => console.log(err))
                    }
                });
            },
            uploadBookReport(){
                let formData = new FormData();
                console.log('first'+this.file);

                formData.append('file', this.file);
                formData.append('student_id', this.student_id);

                axios.post('api/student.uploadBookReport',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    console.log(res);
                    location.reload();
                }).catch(error => {
                    console.log(error);
                })
            },
            downloadBookReport(id){
                console.log(id);
                window.open(`api/student.downloadBookReport/${$('#user_id').val()}`, '_blank');
            },
            deleteBookReport(id){
                console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Once applied you can not change semester.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/student.deleteBookReport/${$('#user_id').val()}`,{
                            method: 'get'
                        })
                        .then(data => {
                            swal({
                                icon: "success",
                                title: "Success!",
                                text: "You have successfully applied for intern.",
                                type: "success"
                            }).then(function() {
                                window.location = "redirectURL";
                            });
                        })
                        .catch(err => console.log(err))
                    }
                });
            },
            handleFileUpload(){
                this.file = '';
                this.file = this.$refs.file.files[0];
                console.log(this.file);
            },
            handleFileUpload2(){
                this.file = '';
                this.file = this.$refs.file2.files[0];
                console.log(this.file);
            },
            handleFileUpload3(){
                this.file = '';
                this.file = this.$refs.file3.files[0];
                console.log(this.file);
            },
        }
    }
</script>

