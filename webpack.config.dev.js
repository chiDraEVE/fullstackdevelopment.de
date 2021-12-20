const { merge } = require("webpack-merge")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const common = require("./webpack.config.common")
const path = require("path")

module.exports = merge(common, {
	mode: "development",
	devtool: "inline-source-map",
	devServer: {
		allowedHosts: [
			"wp-unit.local",
			"fullstackdevelopment.local",
			"clubitsolutions.local",
			"http://blog.clubitsolutions.local"
		],
		watchFiles: ["./**/*.php", "!./functions.php"],
		static: "./assets",
		hot: true,
		headers: {
			"Access-Control-Allow-Origin": "*"
		}
	},
	module: {
		rules: [
			{
				test: /\.s[ac]ss$/i,
				use: [
					"style-loader",
					{
						loader: "css-loader",
						options: {
							sourceMap: true
						}
					},
					{
						loader: "sass-loader",
						options: {
							sourceMap: true
						}
					}
				]
			}
		]
	}
})
