const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { merge } = require("webpack-merge");
const common = require("./webpack.config.common");

module.exports = merge(common, {
	mode: "production",
	module: {
		rules: [
			{
				test: /\.s[ac]ss$/i,
				use: [
					MiniCssExtractPlugin.loader,
					// Translates CSS into CommonJS
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
