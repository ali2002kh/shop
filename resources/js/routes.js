import * as VueRouter from "vue-router";
import Home from "./pages/Home";
import Product from "./pages/Product";
import Login from "./pages/Login";
import Signup from "./pages/Signup";
import Profile from "./pages/Profile";

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
    {
        path: "/login",
        component: Login,
        name:"login",
    },
    {
        path: "/signup",
        component: Signup,
        name:"signup",
    },
    {
        path: "/profile",
        component: Profile,
        name:"profile",
    },
];

const router = new VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});

export default router;