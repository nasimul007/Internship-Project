import adminHome from './Home';
import adminStudentRegistration from './StudentRegistration';
import adminTeachers from './TeacherList';
import adminStudents from './StudentList';
import adminApproveRegistration from './ApproveRegistration';
import adminApproveEnrollment from './ApproveEnrollment';
import adminProfile from './Profile';
import adminNotice from './Notice';
import adminSemester from './Semester';
import adminBatchList from './BatchList';
import adminSupervisors from './SupervisorList';
import adminRequestToComplete from './RequestToComplete';
import adminCompany from './Company';
import adminStudentWithoutBatch from './StudentWithoutBatch';
import adminTA from './TA';


const routes =[
    // {   path : '*', redirect: '/' },
 //Student Routing
     {   path : '/admin', component : adminHome, meta : {authAdmin : true} },
     {   path : '/adminStudentRegistration', component : adminStudentRegistration, meta : {authAdmin : true} },
     {   path : '/adminTeachers', component : adminTeachers, meta : {authAdmin : true} },
     {   path : '/adminStudents', component : adminStudents, meta : {authAdmin : true} },
     {   path : '/adminApproveRegistration', component : adminApproveRegistration, meta : {authAdmin : true} },
     {   path : '/adminApproveEnrollment', component : adminApproveEnrollment, meta : {authAdmin : true} },
     {   path : '/adminProfile', component : adminProfile, meta : {authAdmin : true} },
     {   path : '/adminNotice', component : adminNotice, meta : {authAdmin : true} },
     {   path : '/adminSemester', component : adminSemester, meta : {authAdmin : true} },
     {   path : '/adminBatchList', component : adminBatchList, meta : {authAdmin : true} },
     {   path : '/adminSupervisors', component : adminSupervisors, meta : {authAdmin : true} },
     {   path : '/adminRequestToComplete', component : adminRequestToComplete, meta : {authAdmin : true} },
     {   path : '/adminCompany', component : adminCompany, meta : {authAdmin : true} },
     {   path : '/adminStudentWithoutBatch', component : adminStudentWithoutBatch, meta : {authAdmin : true} },
     {   path : '/adminTA', component : adminTA, meta : {authAdmin : true} },
];

export default routes;