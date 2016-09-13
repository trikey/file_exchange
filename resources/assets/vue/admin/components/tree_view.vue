<template>
    <div></div>
</template>

<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    TreeView = Vue.extend
        props: ['data']
        methods:
            drawTree: ->
                $(this.$el).treeview
                    data: this.data
                    onNodeSelected: (event, data) =>
                        this.$emit 'node-selected', data
        watch:
            data: ->
                this.drawTree() if this.data != null
    module.exports = TreeView
</script>