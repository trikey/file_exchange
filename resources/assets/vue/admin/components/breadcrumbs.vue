<template>
    <ol class="breadcrumb">
        <li><a v-link="{name: 'root'}">{{ $t('messages.main') }}</a></li>
        <breadcrumb v-for="breadcrumb in breadcrumbs" :breadcrumb="breadcrumb"></breadcrumb>
    </ol>
</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    BreadCrumb = require('./breadcrumb')
    module.exports = Vue.extend
        props: ['breadcrumbs']
        components:
            breadcrumb: BreadCrumb
</script>