Vue = require('vue')
VueResource = require('vue-resource')
VueRouter = require('vue-router')
VueI18n = require('vue-i18n')

Locales = require('../vue-i18n-locales.generated')

Vue.use(VueResource)
Vue.use(VueRouter)
Vue.use(VueI18n)

Vue.use(VueI18n)
Vue.locale('en', Locales.en)

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