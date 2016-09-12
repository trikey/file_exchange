<template>

    <form method="GET" action="/search" accept-charset="UTF-8" class="" novalidate="novalidate" id="search_form">
    <div class="form-search">
        <input placeholder="Начните вводить запрос например RHG-2427" class="form-control search-input" id="search" name="query" type="text">
        <input class="btn-search" type="submit" value="">
    </div>

</form>

</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    SearchForm = Vue.extend({})
    module.exports = SearchForm
</script>