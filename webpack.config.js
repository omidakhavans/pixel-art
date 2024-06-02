/**
 * External dependencies
 */
const path = require( 'path' );

/**
 * WordPress dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const sharedConfig = {
	...defaultConfig,
	output: {
		path: path.resolve( process.cwd(), 'build' ),
		filename: '[name]/index.js',
		chunkFilename: '[name]/index.js?v=[chunkhash]',
		publicPath: '',
	},
	resolve: {
		fallback: {
			path: require.resolve( 'path-browserify' ),
		},
	},
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: [ '@babel/preset-react' ],
					},
				},
			},
		],
	},
};

const Admin = {
	...sharedConfig,
	entry: {
		admin: './assets/src/admin/index.js',
	},
};

const Block = {
	...sharedConfig,
	entry: {
		block: './src/Block/index.js',
	},
};

module.exports = [ Admin, Block ];
