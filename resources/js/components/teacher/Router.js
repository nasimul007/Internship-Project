import teacherHome from './Home';
import teacherBatch from './Batch';
import teacherNotice from './Notice';
import teacherProfile from './Profile';
import teacherStudentList from './StudentList';
import teacherCompany from './Company';
import teacherUMSStudent from './UMSStudent';
import teacherToken from './Token';
import teacherChangeCompany from './ChangeCompany';
import teacherTA from './TA';


const routes =[
    // {   path : '*', redirect: '/' },
 //Teacher Routing
    {   path : '/teacher', component : teacherHome, meta : {authTeacher : true} },
    {   path : '/teacherBatch', component : teacherBatch, meta : {authTeacher : true} },
    {   path : '/teacherNotice', component : teacherNotice, meta : {authTeacher : true} },
    {   path : '/teacherProfile', component : teacherProfile, meta : {authTeacher : true} },
    {   path : '/teacherStudentList', component : teacherStudentList, meta : {authTeacher : true} },
    {   path : '/teacherCompany', component : teacherCompany, meta : {authTeacher : true} },
    {   path : '/teacherUMSStudent', component : teacherUMSStudent, meta : {authTeacher : true} },
    {   path : '/teacherToken', component : teacherToken, meta : {authTeacher : true} },
    {   path : '/teacherChangeCompany', component : teacherChangeCompany, meta : {authTeacher : true} },
    {   path : '/teacherTA', component : teacherTA, meta : {authTeacher : true} },
];

export default routes;