Vue = require('vue')
VueResource = require('vue-resource')
VueRouter = require('vue-router')
VueI18n = require('vue-i18n')
VueValidator = require('vue-validator')

Locales = require('../vue-i18n-locales.generated')

Vue.use(VueResource)
Vue.use(VueRouter)
Vue.use(VueI18n)
Vue.use(VueValidator)

Vue.use(VueI18n)
lang = document.querySelector('body').getAttribute('data-lang')
Vue.locale('en', Locales[lang])

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

router = new VueRouter()
app = Vue.extend({})

router.map(
    {
        '/': {
            name: 'root',
            component: require('./pages/root')
        },
        '/:id': {
            name: 'folder',
            component: require('./pages/folder')
        }
    }
)
router.start(app, 'body')