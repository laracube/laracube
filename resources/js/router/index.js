import Vue from 'vue';
import Router from 'vue-router';
import Error404 from '@/views/Error404';
import Home from '@/views/Home';
import Report from '@/views/Report';
import store from '@/store';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

Vue.use(Router);

const router = new Router({
    base: window.LaracubeConfig.path,
    mode: 'history',
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        }
        if (to.hash) {
            return { selector: to.hash };
        }
        return { x: 0, y: 0 };
    },
    routes: [
        {
            name: 'home',
            path: '/',
            component: Home,
        },
        {
            name: 'report',
            path: '/report/:uriKey',
            component: Report,
        },
        {
            name: '404',
            path: '/404',
            component: Error404,
        },
        {
            name: 'catch-all',
            path: '*',
            component: Error404,
        },
    ],
});

router.beforeEach((to, from, next) => {
    store.dispatch('axios/CANCEL_PENDING_REQUESTS');
    if (!to.hash && typeof document !== 'undefined') {
        NProgress.configure({ showSpinner: false });
        NProgress.start();
    }
    next();
});

router.afterEach((to, from) => {
    if (!to.hash && typeof document !== 'undefined') {
        NProgress.done();
    }
});

export default router;
