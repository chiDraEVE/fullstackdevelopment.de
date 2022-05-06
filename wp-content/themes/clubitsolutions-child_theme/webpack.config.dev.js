const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { merge } = require("webpack-merge");
const common = require("./webpack.config.common");

module.exports = merge(common, {
	mode: "development",
	devtool: "inline-source-map",
	devServer: {
		allowedHosts: [
			"wp-unit.local",
			"fullstackdevelopment.local",
			"clubitsolutions.local",
			"http://blog.clubitsolutions.local",
		],
		watchFiles: ["./**/*.php", "!./functions.php"],
		static: "./assets",
		port: 8082,
		hot: true,
		headers: {
			"Access-Control-Allow-Origin": "*",
		},
	},
	module: {
		rules: [
			{
				test: /\.s[ac]ss$/i,
				use: [
					{ loader: "style-loader" },
					{
						loader: "css-loader",
						options: { importLoaders: 1 },
					},
					{
						loader: "postcss-loader",
						options: {
							postcssOptions: {
								plugins: [
									[
										"autoprefixer",
										{
											// Options
										},
									],
								],
							},
						},
					},
					{
						loader: "sass-loader",
						options: { sourceMap: true },
					},
				],
			},
			{
				test: /\.(png|svg|jpg|jpeg|gif)$/i,
				type: "asset/resource",
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "[name].css",
		}),
	],
});
