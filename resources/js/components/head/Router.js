import headHome from './Home';
import headBatchList from './BatchList';
import headTeachers from './TeacherList';
import headCompany from './Company';
import headProfile from './Profile';


const routes =[
    // {   path : '*', redirect: '/' },
 //Student Routing
     {   path : '/head', component : headHome, meta : {authHead : true} },
     {   path : '/headBatchList', component : headBatchList, meta : {authHead : true} },
     {   path : '/headTeachers', component : headTeachers, meta : {authHead : true} },
     {   path : '/headCompany', component : headCompany, meta : {authHead : true} },
     {   path : '/headProfile', component : headProfile, meta : {authHead : true} },
];

export default routes;