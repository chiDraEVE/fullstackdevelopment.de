const path = require("path");

module.exports = {
	entry: {
		index: "./index.js",
	},
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
		clean: true,
		assetModuleFilename: "[name][ext]",
	},
};
