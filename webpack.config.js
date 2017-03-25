var CopyWebpackPlugin = require('copy-webpack-plugin');
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var CleanCSSPlugin = require("less-plugin-clean-css");
var AutoprefixPlugin = require("less-plugin-autoprefix");
var path = require('path');

/*
 * Capitalize drive letter on windows as workaround for
 * webpack bug.
 * https://github.com/webpack/webpack/issues/4530
 */
var outputPath = path.resolve(__dirname, 'src/');
outputPath = outputPath.charAt(0).toUpperCase() + outputPath.slice(1);

module.exports = {
    entry: [
        "./src/js/main.ts",
        "./src/style.less"
    ],
    output: {
        path: outputPath,
        filename: "main-build.js"
    },
    resolve: {
        extensions: [".webpack.js", ".web.js", ".ts", ".tsx", ".js"]
    },
    plugins: [
        new ExtractTextPlugin("style.css"),
        new CopyWebpackPlugin([
            {
                from: 'node_modules/font-awesome/fonts/**',
                to: 'vendor-assets/font-awesome/',
                flatten: true,
                ignore: '*.otf'
            },
            {
                from: 'node_modules/typeface-ubuntu/files/**',
                to: 'vendor-assets/typeface-ubuntu/files/',
                flatten: true
            }
        ])
    ],
    module: {
        loaders: [
            { test: /\.tsx?$/, loader: "ts-loader" },
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract({ use: 'css-loader' })
            },
            {
                test: /\.less$/,
                loader: ExtractTextPlugin.extract({
                    use: [
                        {
                            loader: "css-loader",
                            options: {
                                url: false
                            }
                        },
                        {
                            loader: "less-loader",
                            options: {
                                plugins: [
                                    {
                                        install: function(less, pluginManager) {
                                            pluginManager.addPostProcessor({
                                                process: function(css) {
                                                    return css.replace(/\.\.\/node_modules\//g, 'vendor-assets/');
                                                }
                                            });
                                        }
                                    },
                                    new CleanCSSPlugin({advanced: true}),
                                    new AutoprefixPlugin()
                                ]
                            }
                        }
                    ]
                })
            }
        ]
    }
};
