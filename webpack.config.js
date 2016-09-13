var path = require('path');
var webpack = require('webpack');
module.exports = {
    entry: {
        admin: path.join(__dirname, 'resources', 'assets', 'vue', 'admin', 'admin.coffee'),
        client: path.join(__dirname, 'resources', 'assets', 'vue', 'client', 'client.coffee'),
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
            },
            {
                test: /\.vue$/,
                loader: 'vue',
            }
        ]

    },

    resolve: {
        extensions: ['', '.js', '.coffee', '.vue'],
        alias: {
            _admin: path.join(__dirname, 'resources', 'assets', 'vue', 'admin')
        }
    },

    plugins: [
        new webpack.OldWatchingPlugin()
    ]
};