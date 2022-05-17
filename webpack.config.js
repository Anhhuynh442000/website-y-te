const path = require('path');
require('@babel/polyfill');
require('./entry');

module.exports = {
    // Update: Goto entry file to add file compile
    entry: entry,
    output: {
        path: path.resolve(__dirname, 'public/js/dist'),
        filename: '[name].js'
    },
    devtool: 'inline-source-map',
    module: {
        rules: [
            {
                test: /\.(js|ts|jsx|tsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            '@babel/preset-env',
                            '@babel/preset-typescript',
                            ['@babel/preset-react', { runtime: 'automatic' }]
                        ],
                        plugins: ['@babel/plugin-transform-runtime'],
                    }
                }
            },
            {
                test: /\.(sass|scss|css)$/i,
                use: ['style-loader', 'css-loader', 'sass-loader', 'postcss-loader']
            },
            {
                test: /\.(png|jpe?g|gif)$/i,
                loader: 'file-loader',
                options: {
                    name: 'images/[name].[ext]'
                }
            },
            {
                test: /\.svg$/,
                use: ['@svgr/webpack']
            }
        ]
    },
    resolve: {
        extensions: ['*', '.js', '.ts', '.jsx', '.tsx']
    }
};
