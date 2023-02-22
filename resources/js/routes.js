import * as VueRouter from "vue-router";
import Home from "./pages/Home";
import Product from "./pages/Product";
import Login from "./pages/Login";
import Signup from "./pages/Signup";
import Profile from "./pages/Profile";
import AboutUs from "./pages/AboutUs";
import Cart from "./pages/Cart";
import Checkout from "./pages/Checkout";
import Order from "./pages/Order";
import Category from "./pages/Category";

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
    {
        path: "/about-us",
        component: AboutUs,
        name:"about-us",
    },
    {
        path: "/cart",
        component: Cart,
        name:"cart",
    },
    {
        path: "/checkout",
        component: Checkout,
        name:"checkout",
    },
    {
        path: "/order/:code",
        component: Order,
        name:"order",
    },
    {
        path: "/category/:name",
        component: Category,
        name:"category",
    },
];

const router = new VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});

export default router;