var path = require('path');

module.exports = {
    entry: {
        app: path.join(__dirname, 'resources', 'assets', 'vue', 'index.coffee'),
    },

    output: {
        filename: '[name].js',
        path: path.join(__dirname, 'public', 'build'),
    },

    module: {

        loaders: [
            {
                test: /\.coffee$/,
                loader: 'coffee',
            }
        ]

    },

    resolve: {
        extensions: ['', '.js', '.coffee']
    }
};