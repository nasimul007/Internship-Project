import studentHome from './Home';
import studentUpload from './Upload';
import studentSupervisor from './Supervisor';
import studentProfile from './Profile';
import studentCompany from './Company';



const routes =[
 //----------------Student Routing------------------------
 
     {   path : '/student', component : studentHome , meta : {authStudent : true} },
     {   path : '/studentUpload', component : studentUpload , meta : {authStudent : true} },
     {   path : '/studentSupervisor', component : studentSupervisor , meta : {authStudent : true} },
     {   path : '/studentProfile', component : studentProfile , meta : {authStudent : true} },
     {   path : '/studentCompany', component : studentCompany , meta : {authStudent : true} },
];

export default routes;