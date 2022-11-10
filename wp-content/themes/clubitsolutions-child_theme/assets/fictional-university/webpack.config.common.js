const path = require("path");

module.exports = {
	entry: {
		index: "./assets/fictional-university/src/index.js",
	},
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
	},
};