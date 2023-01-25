const path = require("path");

module.exports = {
	entry: {
		index: "./index.js",
		fictionalUniversity: "./assets/fictional-university/src/fictional-university.js",
		natours: "./assets/advanced-css/natours/natours.js",
		nexter: "./assets/advanced-css/nexter/nexter.js",
		trillo: "./assets/advanced-css/trillo/trillo.js",
	},
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
		clean: true,
		assetModuleFilename: "[name][ext]",
	},
};
