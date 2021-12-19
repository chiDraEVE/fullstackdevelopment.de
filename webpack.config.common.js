const path = require("path")

module.exports = {
	entry: {
		index: "./js/index.js",
		dark_mode: "./js/dark-mode.js"
	},
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "assets"),
		clean: true
	}
}
