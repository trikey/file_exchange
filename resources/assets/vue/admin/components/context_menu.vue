<template>
    <div id="{{ id }}">
        <ul class="dropdown-menu" role="menu">
            <slot></slot>
        </ul>
    </div>
</template>


<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    module.exports = Vue.extend
        props: ['id']
        data: ->
            activator: null
        ready: ->
            this.activator = $(this.$el).prev()
            this.activator.contextmenu();
            this.activator.on 'shown.bs.context', =>
                this.$emit 'shown'

            this.activator.on 'hidden.bs.context', =>
                this.$emit 'hidden'
        methods:
            close: ->
                this.activator.contextmenu('closemenu')
</script>