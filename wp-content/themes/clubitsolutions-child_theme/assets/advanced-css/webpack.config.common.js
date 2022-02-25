const path = require("path");

module.exports = {
	entry: {
		index: "./assets/advanced-css/index.js",
		nexter: "./assets/advanced-css/nexter/nexter.js",
	},
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
	},
};
