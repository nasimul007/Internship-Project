import superAdminHome from './Home';
import superAdminTeachers from './TeacherList';
import superAdminStudents from './StudentList';
import superAdminProfile from './Profile';
import superAdminCompany from './Company';


const routes =[
    // {   path : '*', redirect: '/' },
 //Student Routing
     {   path : '/superAdmin', component : superAdminHome, meta : {authSA : true} },
     {   path : '/superAdminTeachers', component : superAdminTeachers, meta : {authSA : true} },
     {   path : '/superAdminStudents', component : superAdminStudents, meta : {authSA : true} },
     {   path : '/superAdminProfile', component : superAdminProfile, meta : {authSA : true} },
     {   path : '/superAdminCompany', component : superAdminCompany, meta : {authSA : true} },
];

export default routes;