const path = require("path");

module.exports = {
	entry: {
		index: "./assets/advanced-css/index.js",
		nexter: "./assets/advanced-css/nexter/nexter.js",
		natours: "./assets/advanced-css/natours/natours.js",
		trillo: "./assets/advanced-css/trillo/trillo.js",
	},
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
	},
};
