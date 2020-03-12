<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Change Companies
                        <small>teacher</small>
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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Companies</span>
                                </div>
                                <div class="actions">
                                    <table border="0">
                                        <tr>
                                            <td >
                                                <div class="dropdown show " style="margin-left:5%;">
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Save or Export
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:60px;">
                                                        <a  class="btn red btn-outline dropdownCustom" @click="exportPdf()">Save as PDF <i class="fa fa-file-pdf-o"></i></a>
                                                        <a  class="btn blue btn-outline dropdownCustom" @click="exportExcel()">Export to Excel <i class="fa fa-file-excel-o"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" border="1">
                                    <thead>
                                        <tr>
                                            <th style="display:none;"> </th>
                                            <th> Student Id</th>
                                            <th> Company Name</th>
                                            <th> Company Type</th>
                                            <th> Options </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX" v-for="c in companies" :key="c.company_id">
                                            
                                            <td style="display:none;"> </td>
                                            <td> {{c.student_id}} </td>
                                            <td> {{c.company_name}} </td>
                                            <td> {{c.company_type}} </td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:100px;">
                                                        <a  class="btn blue btn-outline dropdownCustom" data-toggle="modal" href="#basic" @click.prevent="detailsCompany(c.company_id)">Details</a>
                                                        <a  class="btn red btn-outline dropdownCustom"  @click="deleteCompany(c.company_id)">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                        <h4 class="modal-title">Validation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <table class="table table-bordered order-column">
                                        <thead>
                                            <tr>
                                                <th> Criteria </th>
                                                <th> Previous Details </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td><strong>Name  </strong> </td><td> {{oldData.company_name}}</td></tr>
                                            <tr><td><strong>Type  </strong> </td><td> {{oldData.company_type}}</td></tr>
                                            <tr><td><strong>Address </strong> </td><td> {{oldData.company_address}}</td></tr>
                                            <tr><td><strong>Mobile No </strong> </td><td> +880 {{oldData.company_contact}}</td></tr>
                                            <tr><td><strong>Website  </strong> </td><td> {{oldData.company_website}}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-warning">
                                    <table class="table table-bordered order-column">
                                        <thead>
                                            <tr><th> New Details </th></tr>
                                        </thead>
                                        <tbody>
                                            <tr><td><input type="text" class="form-control" v-model="company.company_name" name="company_name" /></td></tr>
                                            <tr><td><input type="text" class="form-control" v-model="company.company_type" name="company_type" /> </td></tr>
                                            <tr><td><input type="text" class="form-control" v-model="company.company_address" name="company_address" /> </td></tr>
                                            <tr><td>+880<input type="text" class="form-control" v-model="company.company_contact" name="company_contact" />  </td></tr>
                                            <tr><td><input type="text" class="form-control" v-model="company.company_website" name="company_website" /> </td></tr>
                                            <tr><td><button @click.prevent="updateCompany(company.company_id)" class="btn green">Save Changes</button> </td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
.table thead tr th {
    text-align: center;
} 

.table tbody tr td {
    text-align: center;
}

.dropdownCustom {
    width: 100%;
    display: block;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
}
</style>

    
<script>
import { Validator } from 'vee-validate';


    export default {
        mounted() {
            //console.log('Component mounted.')
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
                companies: [],
                company: {
                    company_id: '',
                    company_name: '',
                    company_type: '',
                    company_contact: '',
                    company_address: '',
                    company_website: ''
                },
                add: true,
                edit: false,
                oldData: '',
                newData: '',
            }
        },
        created(){
            this.viewCompanies($('#user_id').val());
        },
        methods: {
            viewCompanies(id){
                fetch(`api/teacher.teacherChangeCompanyLoad/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.companies = res;
                })
                .catch(err => console.log(err));
            },
            detailsCompany(id){
                fetch(`api/teacher.oldCompany/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.oldData = res;
                })
                .catch(err => console.log(err));

                fetch(`api/teacher.newCompany/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    //this.newData = res;

                    this.company.company_id = res.company_id;
                    this.company.company_name = res.company_name;
                    this.company.company_type = res.company_type;
                    this.company.company_address = res.company_address;
                    this.company.company_contact = res.company_contact;
                    this.company.company_website = res.company_website;

                })
                .catch(err => console.log(err));
            },
            updateCompany(id){
                //console.log(id);
                fetch('api/teacher.updateReqToChange',{
                    method: 'post',
                    body: JSON.stringify(this.company),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(res => {
                    swal('Success!', "Company details updated.", 'success');
                    this.viewCompanies($('#user_id').val());
                })
                .catch(err => console.log(err))
            },
            deleteCompany(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Company details will be removed.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/teacher.teacherChangeCompanyDelete/${id}`,{
                            method: 'delete'
                        })
                        .then(res => res.json())
                        .then(res => {
                            swal("Company details removed.", {
                                icon: "success",
                            });
                            this.viewCompanies($('#user_id').val());
                        })
                        .catch(err => console.log(err))
                        
                    }
                });
            },
            exportPdf(){
                // $("#sample_1").tableHTMLExport({
                //     ignoreColumns: 'sl',
                //     type:'pdf',
                //     filename: 'Teacher List.pdf',
                // });
                $('#sample_1').printThis({
                    importCSS: true,
                    importStyle: false,     // prefix to html
                    pageTitle: "my page",
                    footer: '<h1>yoo success</h1>', 
                    header: "<h1>yoo success</h1>"
                });
            },
            exportExcel(){
                var table = $("#sample_1");
                if(table && table.length){
                    var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                    $(table).table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: "Students" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: preserveColors
                    });
                }
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
