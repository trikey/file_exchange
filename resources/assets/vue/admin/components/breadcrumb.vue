<template>
    <li :class="{ 'active' : breadcrumb.url == undefined }"><a v-if="breadcrumb.url != undefined" href="{{ breadcrumb.url }}">{{ breadcrumb.name }}</a><span v-else>{{ breadcrumb.name. }}</span></li>
</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    module.exports = Vue.extend
        props: ['breadcrumb']
</script>