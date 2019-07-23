const path = require('path');
//const ExtractTextPlugin = require('extract-text-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    entry: "./main.js",
    output: {
        path: path.resolve(__dirname, '../html'),
        filename: 'js/build.js',
        publicPath: '/html/' // todo: хз
    },
    module: {
        rules: [
            /*{
                test: /\.(png|jpg|gif)$/,
                loader: 'file-loader?name=[path][name].[ext]'
            },*/
            {
                test: /\.(png|jpg|svg)$/,
                loader: 'url-loader?limit=8192&name=[path][name].[ext]' // todo: для копирования img в /public
            },
            {
                test: /\.(css|scss)$/,
                use: [
                    // fallback to style-loader in development
                    //process.env.NODE_ENV !== 'production' ? 'style-loader' : MiniCssExtractPlugin.loader,
                    //"style-loader",
                    MiniCssExtractPlugin.loader,
                    "css-loader",
                    "sass-loader"
                ]
            }
            /*{
                test: /\.(css|scss)$/,
                use: ExtractTextPlugin.extract(
                    {
                        fallback: 'style-loader',
                        use: ['css-loader', /*'resolve-url-loader', * /'sass-loader']
                        /*
                        use: [{
                            loader: "css-loader"
                        }, {
                            loader: "sass-loader"/*,
                            options: {
                                includePaths: ["./img"]
                            }* /
                        }]* /
                    }
                )
            }/*,
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: { // https://vue-loader.vuejs.org/ru/configurations/pre-processors.html
                    scss: 'vue-style-loader!css-loader!sass-loader', // <style lang="scss">
                    //sass: 'vue-style-loader!css-loader!sass-loader?indentedSyntax', // <style lang="sass">
                    extractCSS: true
                }
            }*/
        ]
    },
    plugins: [
        //new ExtractTextPlugin('css/styles.css')
        new MiniCssExtractPlugin({
            filename: "css/[name].css",
            chunkFilename: "css/[id].css"
        })
    ]
}﻿
