import * as VueRouter from "vue-router";
import Home from "./pages/Home";
import Product from "./pages/Product";

const routes = [
    {
        path: "/",
        component: Home,
        name:"home",
    },
    {
        path: "/product/:id",
        component: Product,
        name:"product",
    },
];

const router = new VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});

export default router;