import VueRouter from 'vue-router';

let routes = [
    // Merchants
    {path: '/',component: require('./components/Index')},
    {path: '/create',component: require('./components/Create')},
    {path: '/update/:id',component: require('./components/Update'),props: true},
];

export default new VueRouter({
    routes,
})
