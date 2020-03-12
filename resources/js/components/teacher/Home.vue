<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <!-- <div class="page-title">
                    <h1>Home
                        <small>admin</small>
                    </h1>
                </div> -->
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
                                <!-- <i class="icon-social-dribbble font-blue-sharp"></i> -->
                                <i class="fa fa-home font-blue-sharp"></i>
                                <span class="caption-subject font-blue-sharp bold uppercase">Home</span>
                            </div>
                            <div class="actions">
                                
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row" style="margin-bottom: 1%;">
                                <div class="col-md-4" style="border-right: 1px solid #ccc">
                                    <h4>Student Registration Details ({{this.semester}})</h4>
                                    <canvas ref="chart3" ></canvas>
                                </div>
                                <div class="col-md-4" style="border-right: 1px solid #ccc">
                                    <h4>Student Intern Details ({{this.semester}})</h4>
                                    <canvas ref="chart4" ></canvas>
                                </div>
                                <div class="col-md-4">
                                    <h4>Batch Details ({{this.semester}})</h4>
                                    <canvas ref="chart5" ></canvas>
                                </div>
                            </div>
                            <div class="row" style="border-top: 1px solid #ccc">
                                <div class="col-md-6" >
                                    <h4>Other Details </h4>
                                    <canvas ref="chart1"></canvas><br>
                                </div>
                                <div class="col-md-6" >
                                    <h4>Company Details </h4>
                                    <canvas ref="chart2" ></canvas><br>
                                </div>
                            </div>
                            
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

import Chart from 'chart.js';



    export default {
        mounted() {
            console.log('Component mounted.')
            const plugin = document.createElement("script");

            plugin.setAttribute(
            "src",
            "assets/pages/scripts/table-datatables-managed.min.js"
            );
                
            plugin.async = true;
            document.body.appendChild(plugin);

            this.loadOther();
            this.loadCompany();
            this.loadReg();
            this.loadIntern();
            this.loadBatch();
        },
        data(){
            return{
                intern: {
                    allowed: '',
                    not_allowed: ''
                },
                registration: {
                    allowed: '',
                    not_allowed: ''
                },
                batch: {
                    allowed: '',
                    not_allowed: ''
                },
                students: '',
                company:{
                    verified: '',
                    non_verified: ''
                },
                semester: '',
                semesters: '',
                teachers: '',
                supervisors: '',
            }
        },
        created(){
            this.viewOthers();
            this.viewStudents();
        },
        methods: {
            viewStudents(){
                fetch('api/students.count')
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.intern.allowed = res.intern_v;
                    this.intern.not_allowed = res.intern_non_v;

                    this.registration.allowed = res.registration_v;
                    this.registration.not_allowed = res.registration_non_v;

                    this.batch.allowed = res.batch_v;
                    this.batch.not_allowed = res.batch_non_v;

                    this.semester = res.semester;

                    this.loadReg();
                    this.loadIntern();
                    this.loadBatch();
                })
                .catch(err => console.log(err));
            },
            loadReg(){
                //console.log(this.company.verified);

                var chart = this.$refs.chart3;
                var ctx = chart.getContext("2d");
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Allowed ("+this.registration.allowed+")", "Not-allowed ("+this.registration.not_allowed+")"],
                        datasets: [{
                            label: '# of Votes',
                            data: [this.registration.allowed, this.registration.not_allowed],
                            backgroundColor: [
                                'rgba(88, 215, 0, 0.6)',
                                'rgba(255, 117, 26, 0.6)'
                            ],
                            borderColor: [
                                'rgba(88, 215, 0, 1)',
                                'rgba(255, 117, 26,1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            },
            loadIntern(){
                //console.log(this.company.verified);

                var chart = this.$refs.chart4;
                var ctx = chart.getContext("2d");
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Allowed ("+this.intern.allowed+")", "Not-allowed ("+this.intern.not_allowed+")"],
                        datasets: [{
                            label: '# of Votes',
                            data: [this.intern.allowed, this.intern.not_allowed],
                            backgroundColor: [
                                'rgba(88, 215, 0, 0.6)',
                                'rgba(255, 117, 26, 0.6)'
                            ],
                            borderColor: [
                                'rgba(88, 215, 0, 1)',
                                'rgba(255, 117, 26,1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            },
            loadBatch(){
                //console.log(this.company.verified);

                var chart = this.$refs.chart5;
                var ctx = chart.getContext("2d");
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Approved ("+this.batch.allowed+")", "Not-Approved ("+this.batch.not_allowed+")"],
                        datasets: [{
                            label: '# of Votes',
                            data: [this.batch.allowed, this.batch.not_allowed],
                            backgroundColor: [
                                'rgba(88, 215, 0, 0.6)',
                                'rgba(255, 117, 26, 0.6)'
                            ],
                            borderColor: [
                                'rgba(88, 215, 0, 1)',
                                'rgba(255, 117, 26,1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            },
            viewOthers(){
                fetch('api/others.count')
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.company.verified = res.company_v;
                    this.company.non_verified = res.company_non_v;
                    this.semesters = res.semesters;
                    this.teachers = res.teachers;
                    this.supervisors = res.supervisors;
                    this.students = res.students;

                    this.loadOther();
                    this.loadCompany();
                })
                .catch(err => console.log(err));
            },
            loadOther(){
                var chart = this.$refs.chart1;
                var ctx = chart.getContext("2d");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [ "Students ("+this.students+")", "Teachers ("+this.teachers+")", "Semesters ("+this.semesters+")", "Supervisors ("+this.supervisors+")"],
                        datasets: [{
                            label: '# of Counting',
                            data: [this.students, this.teachers, this.semesters, this.supervisors],
                            backgroundColor: [
                                'rgba(77, 121, 255, 0.6)',
                                'rgba(209, 26, 255, 0.6)',
                                'rgba(255, 255, 0, 0.6)',
                            ],
                            borderColor: [
                                'rgba(77, 121, 255, 1)',
                                'rgba(209, 26, 255, 1)',
                                'rgba(255, 255, 0, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                    
                });
            },
            loadCompany(){
                var chart = this.$refs.chart2;
                var ctx = chart.getContext("2d");
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: [ "Verified ("+this.company.verified+")", "Non-verified ("+this.company.non_verified+")"],
                        datasets: [{
                            label: '# of Counting',
                            data: [this.company.verified, this.company.non_verified],
                            backgroundColor: [
                                'rgba(88, 215, 0, 0.6)',
                                'rgba(255, 117, 26, 0.6)',
                            ],
                            borderColor: [
                                'rgba(88, 215, 0, 1)',
                                'rgba(255, 117, 26, 1)',
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            },
            
        }
    }
</script>
