const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const webpack = require('webpack');
// const MinifyPlugin = require('babel-minify-webpack-plugin');

const mode = 'development';

const entry = path.resolve(__dirname, 'src', 'index.js');

const output = {
    path: path.resolve(__dirname, 'built'),
    filename: 'index.js'
};

const modules = {
    rules: [
        {
            test: /\.styl/,
            use: [
                MiniCssExtractPlugin.loader,
                'css-loader',
                'stylus-loader'
            ]
        },
        {
            test: /\.scss/,
            use: [
                MiniCssExtractPlugin.loader,
                'css-loader',
                'sass-loader'
            ]
        },
        {
            test: /\.css/,
            use: [
                { loader: MiniCssExtractPlugin.loader },
                'css-loader'
            ]
        },
        {
            test: /\.(png|jpg|woff|woff2|eot|ttf|svg|otf)$/,
            loader: 'url-loader?limit=100000'
        }
    ]
};

const plugins = [
    new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        jquery: 'jquery'
    }),
    new MiniCssExtractPlugin({
        filename: "[name].css",
        chunkFilename: "[id].css"
    }),
    // new MinifyPlugin()
];

module.exports = {
    mode,
    module: modules,
    entry,
    output,
    plugins
};