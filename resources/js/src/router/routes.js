const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: () => import('@/Layouts/AuthLayout.vue'),
        meta: {
            isIndex: false,
            requiresAuth: true
        },
        redirect: {name: "task-management"},
        children: [
            {
                path: 'management',
                name:'management',
                redirect: {name: "role.page"},
                meta: {
                    label: 'Management',
                },
                children:[
                    {
                        path: 'role/page',
                        name: 'role.page',
                        component: () => import ('@/views/RolePage.vue'),
                        meta: {
                            sidebar:true,
                            label: 'Access Role',
                            key: 'role-page',
                        },
                    },
                    {
                        path: 'user/add',
                        name: 'user.add',
                        component: () => import ('@/views/Dashboard.vue'),
                        meta: {
                            sidebar: false,
                            label: 'User Add',
                            key: 'user-add',
                        }
                    },
                ]
            },
            {
                path: 'task',
                name:'task-management',
                redirect: {name: "task.list"},
                meta: {
                    label: 'Task Management',
                },
                children:[
                    {
                        path: 'list',
                        name: 'task.list',
                        component: () => import ('@/views/TaskList.vue'),
                        meta: {
                            sidebar:true,
                            label: 'Task',
                            key: 'task-list',
                        },
                    },
                    {
                        path: 'add',
                        name: 'task.add',
                        component: () => import ('@/views/Dashboard.vue'),
                        meta: {
                            sidebar: false,
                            label: 'Task Add',
                            key: 'task-add',
                        }
                    },
                ]
            },
        ]
    },
    {
        path: '/login',
        name: 'Login',
        component: () =>
            import ('@/views/Login.vue'),
        meta: {
            requiresAuth: false,
            isLoginRoute: true
        },
    },

    /*{
        path: "/:catchAll(.*)",
        name: '404',
        component: () =>
            import ('@/components/Content/404.vue'),
        meta: {
            requiresAuth: false
        }
    },
*/

]

export default routes;
