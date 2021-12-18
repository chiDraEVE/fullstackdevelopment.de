const { merge } = require( 'webpack-merge' );
const common = require( './webpack.config.common' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const CssMinimizerPlugin = require( 'css-minimizer-webpack-plugin' );

module.exports = merge( common, {
	mode: 'production',
	module: {
		rules: [
			{
				test: /.s?css$/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'sass-loader',
				],
			},
		],
	},
	optimization: {
		minimizer: [ new CssMinimizerPlugin() ],
	},
	plugins: [
		new MiniCssExtractPlugin( {
			// Options similar to the same options in webpackOptions.output
			// both options are optional
			filename: '[name].css',
			chunkFilename: '[contenthash].css',
		} ),
	],
} );
