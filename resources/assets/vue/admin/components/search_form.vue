<template>

    <form method="GET" action="/search" accept-charset="UTF-8" class="" novalidate="novalidate" id="search_form" v-on:submit.prevent="onSubmit">
    <div class="form-search">
        <input placeholder="Начните вводить запрос например RHG-2427" class="form-control search-input" id="search" v-model="query" type="text">
        <input class="btn-search" type="submit" value="">
    </div>

</form>

</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    module.exports = Vue.extend
        props: ['sort', 'isSearch']
        data: ->
            query: null
        methods:
            onSubmit: ->
                this.$http.get("/api/search?query=#{this.query}&sort=#{this.sort}").then (response) =>
                    this.$emit 'search', response.data
        watch:
            sort: ->
                this.onSubmit() if(this.isSearch)
</script>