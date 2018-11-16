module.exports = {
    entry: "./src/controller.js",
    output: {
        filename: "bundle.js",
        publicPath: "/dist/"
    },
    module: {
        loaders: [{
            exclude: /node_modules/,
            loader: 'babel-loader',
            query: {
                presets: ['es2015','react','stage-1']
            }
        },
        {
        test: /\.css$/,
        include: /app/,
        use: ['style-loader','css-loader']
      }
      ]
    },
    resolve: {
        extensions: ['.js', '.jsx']
    },
    devServer: {
        historyApiFallback: true
    }
};
