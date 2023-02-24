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
import Admin from "./admin/Admin";
import Dashboard from "./admin/Dashboard";
import Products from "./admin/Products";
import CreateProduct from "./admin/CreateProduct";
import EditProduct from "./admin/EditProduct";
import Categories from "./admin/Categories";
import Orders from "./admin/Orders";

const routes = [
    {
        path: "/admin",
        component: Admin,
        children: [
            {
                path: "",
                component: Dashboard,
                name: "dashboard",
            },
            {
                path: "products",
                component: Products,
                name: "products",
            },
            {
                path: "create-product",
                component: CreateProduct,
                name: "create-product",
            },
            {
                path: "edit-product/:id",
                component: EditProduct,
                name: "edit-product",
            },
            {
                path: "categories",
                component: Categories,
                name: "categories",
            },
            {
                path: "orders",
                component: Orders,
                name: "orders",
            },
        ]
    },
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