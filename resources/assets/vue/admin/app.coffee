Vue = require('vue')
VueResource = require('vue-resource')
VueRouter = require('vue-router')

Vue.use(VueResource)
Vue.use(VueRouter)

router = new VueRouter()
app = Vue.extend({})

router.map(
    {
        '/': {
            name: 'root',
            component: require('./pages/root')
        },
        '/folders/:id': {
            name: 'folder',
            component: require('./pages/folder')
        }
    }
)
router.start(app, 'body')