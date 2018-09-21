/**
 * BLOCK: fb-feed
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 
 
 
		accessToken: {
			type: 'string'
		},
		numPosts: {
			type: 'number',
			default: 5
		},
		postLength: {
			type: 'number',
			default: 100
		}
							// <TextControl
								// label={ __( "Facebook Page Access Token" ) }
								// value={accessToken}
								// help={ __( 'https://developers.facebook.com/tools/explorer/145634995501895/' ) }
								// onChange={ this.onAccessTokenChange }
							// />
							// <TextControl
								// label={ __( "Number of Posts (Optional)" ) }
								// value={numPosts}
								// type="number"
								// help={ __( "(eg. 10) Default value : 5" ) }
								// onChange={ this.onNumPostsChange }
							// />
							// <TextControl
								// label={ __( "Each Post Length (Optional)" ) }
								// value={postLength}
								// type="number"
								// help={ __( "(eg. 50) Default value : 100" ) }
								// onChange={ this.onPostLengthChange }
							// />
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { Component, Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, TextControl } = wp.components;

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'branzel/block-fb-feed', {
	title: __( 'Facebook Feed' ), // Block title.
	icon: 'facebook',
	category: 'embed',
	keywords: [
		__( 'fb-feed — Branzel Block' ),
		__( 'social media' ),
		__( 'Facebook' ),
	],
	attributes: {
		pageID: {
			type: 'string'
		},
		feedHeight: {
			type: 'number',
			default: 70
		}
	},

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: class extends Component {
		constructor(props) {
			super(...arguments);
			this.props = props;

			this.onPageIDChange = this.onPageIDChange.bind(this);
			// this.onAccessTokenChange = this.onAccessTokenChange.bind(this);
			// this.onNumPostsChange = this.onNumPostsChange.bind(this);
			// this.onPostLengthChange = this.onPostLengthChange.bind(this);
			this.onFeedHeightChange = this.onFeedHeightChange.bind(this);
		}

		onPageIDChange(pageID) {
			this.props.setAttributes({ pageID });
		}
		
		// onAccessTokenChange(accessToken) {
			// this.props.setAttributes({ accessToken });
		// }
		
		// onNumPostsChange(numPosts) {
			// this.props.setAttributes({ numPosts });
		// }
		
		// onPostLengthChange(postLength) {
			// this.props.setAttributes({ postLength });
		// }
		
		onFeedHeightChange(feedHeight) {
			this.props.setAttributes({ feedHeight });
		}

		render() {
			const { className, attributes: { pageID = '', feedHeight = 70 } = {} } = this.props;

			return (
				<Fragment>
					<InspectorControls>
						<PanelBody title={ __( 'Feed Settings' ) } className="blocks-fb-feed-settings">
							<TextControl
								label={ __( "Facebook Page ID" ) }
								value={pageID}
								help={ __( "Eg. 1234567890123 or bluwebz" ) }
								onChange={ this.onPageIDChange }
							/>
							<TextControl
								label={ __( "Height of the Feed (in px)" ) }
								value={feedHeight}
								type="number"
								help={ __( "Default value : 70" ) }
								onChange={ this.onFeedHeightChange }
							/>
						</PanelBody>
					</InspectorControls>
					<div className={className}>
						<p>{ __( "The Facebook feed will appear here." ) }</p>
					</div>
				</Fragment>
			);
		}
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: function() {
		return null // Server side rendering
	},
} );
