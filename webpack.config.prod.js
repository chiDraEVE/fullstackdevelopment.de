const { merge } = require("webpack-merge")
const common = require("./webpack.config.common")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin")
const { CleanWebpackPlugin } = require("clean-webpack-plugin")
const { WebpackManifestPlugin } = require("webpack-manifest-plugin")
const fse = require("fs-extra")

const postCSSPlugins = [
	require("postcss-import"),
	require("postcss-mixins"),
	require("postcss-simple-vars"),
	require("postcss-nested"),
	require("postcss-hexrgba"),
	require("postcss-color-function"),
	require("autoprefixer")
]

class RunAfterCompile {
	apply(compiler) {
		compiler.hooks.done.tap("Update functions.php", function () {
			// update functions php here
			const manifest = fse.readJsonSync("./assets/manifest.json")

			fse.readFile("./functions.php", "utf8", function (err, data) {
				if (err) {
					console.log(err)
				}

				const scriptsRegEx = new RegExp("/assets/scripts.+?'", "g")
				const vendorsRegEx = new RegExp("/assets/vendors.+?'", "g")
				const cssRegEx = new RegExp("/assets/720.+?'", "g")
				const cssDarkRegEx = new RegExp("/assets/422.+?'", "g")

				let result = data
					.replace(scriptsRegEx, `/assets/${manifest["scripts.js"]}'`)
					.replace(vendorsRegEx, `/assets/${manifest["vendors~scripts.js"]}'`)
					.replace(cssRegEx, `/assets/${manifest["720.css"]}'`)
					.replace(cssDarkRegEx, `/assets/${manifest["422.css"]}'`)

				fse.writeFile("./functions.php", result, "utf8", function (err) {
					if (err) return console.log(err)
				})
			})
		})
	}
}

module.exports = merge(common, {
	mode: "production",
	module: {
		rules: [
			{
				test: /.s?css$/,
				use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"]
			}
		]
	},
	optimization: {
		minimizer: [new CssMinimizerPlugin()]
	},
	plugins: [
		new MiniCssExtractPlugin({
			// Options similar to the same options in webpackOptions.output
			// both options are optional
			filename: "[name].css",
			chunkFilename: "[name].[chunkhash].css"
		}),
		new CleanWebpackPlugin(),
		new WebpackManifestPlugin({ publicPath: "" }),
		new RunAfterCompile()
	]
})
