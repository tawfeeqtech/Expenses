import {createRouter, createWebHistory} from "vue-router";
import TreatmentIndex from "../components/treatmentes/Index";
import TreatmentCreate from "../components/treatmentes/Create";

import notFound from '../components/notFound';


const routes = [
    {
        path: "/treatment",
        name: "TreatmentIndex",
        component: TreatmentIndex,
    },
    {
        path: "/treatment/create",
        name: "TreatmentCreate",
        component: TreatmentCreate,
    },
    {
        path: '/:pathMatch(.*)*', name: 'NotFound', component: notFound
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});
export default router
