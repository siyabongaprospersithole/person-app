import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'
import axios from 'axios';


/* Guest Component */
const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('@/components/layouts/Default.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('@/components/Dashboard.vue')

//New Person
const NewPerson = () => import('@/components/person/AddPerson.vue')

//Edit Person
const EditPerson = () => import('@/components/person/EditPerson.vue').then(module => module.default);


/* Authenticated Component */


/** 404  */

const NotFound = () =>  import('@/components/errors/NotFound.vue');

/** 404 */

const getPersonById = async (id) => {
    try {
      const response = await axios.get(`/api/persons/get/${id}`);
      return response.data.person;
    } catch (error) {
      throw error; // Handle error as needed
    }
  };

  

const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            }
        ]
    },
    {
        path: "/person/new",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
         
            {
                name: "NewPerson",
                path: '/person/new',
                component: NewPerson,
                meta: {
                    title: `NewPerson`
                }
            }
        ]
    },
    {
        path: "/person/edit/:id",
        component: DahboardLayout,
        meta: {
          middleware: "auth"
        },
        children: [
          {
            name: "EditPerson",
            path: '/person/edit/:id',
            component: () => import('@/components/person/EditPerson.vue'), 
            meta: {
              title: `Edit Person`
            },
            async beforeEnter(to, from, next) {
              const { id } = to.params;
              try {
                const person = await getPersonById(id);
                if (person) {
                  // If person exists, pass the person data to the component
                  to.params.person = person;
                  next();
                } else {
                  // If person doesn't exist, redirect to the dashboard or show a 404 page
                  next({ name: 'dashboard' });
                }
              } catch (error) {
                console.error('Error fetching person data:', error);
                // Handle error appropriately (e.g., show error message, redirect to error page)
                next();
              }
            }
          }
        ]
    },
    {
      
        path: '/:pathMatch(.*)',
        component: NotFound
      }

]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})

export default router