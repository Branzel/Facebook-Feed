<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Gutenberg block assets for both frontend + backend.
 *
 * `wp-blocks`: includes block type registration and related functions.
 *
 * @since 1.0.0
 */
function socialfeed_register() {
	// Scripts.
	wp_enqueue_script ( 'branzel-socialfeed-fb-sdk-js',  plugins_url( '/includes/js/fb-sdk-include.js', dirname( __FILE__ ) ), '', '1.0.0', true );
	// wp_enqueue_script ( 'branzel-socialfeed-dot-js',  plugins_url( '/includes/js/doT.min.js', dirname( __FILE__ ) ), '', '1.0.0', true );
	// wp_enqueue_script ( 'branzel-socialfeed-moment-js',  plugins_url( '/includes/js/moment.min.js', dirname( __FILE__ ) ), '', '1.0.0', true );
	// wp_enqueue_script ( 'branzel-socialfeed-js',  plugins_url( '/includes/js/jquery.socialfeed.js', dirname( __FILE__ ) ), array('jquery', 'branzel-socialfeed-moment-js', 'branzel-socialfeed-dot-js' ), '1.0.0', true );
   
	wp_register_script(
		'branzel-socialfeed-block-script',
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ),
		true
	);

	// Styles.
	wp_register_style(
		'branzel-socialfeed-editor-style',
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ),
		array( 'wp-edit-blocks' )
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' )
	);
	
	// Styles.
	wp_enqueue_style(
		'branzel-socialfeed-jquery-style',
		plugins_url( '/includes/css/jquery.socialfeed.css', dirname( __FILE__ ) ),
		array( )
	);
	
	wp_register_style(
		'branzel-socialfeed-frontend-style', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ),
		array( 'wp-blocks' )
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' )
	);
	
	register_block_type( 'branzel/block-fb-feed', array(
		'editor_script' => 'branzel-socialfeed-block-script',
		'editor_style' => 'branzel-socialfeed-editor-style',
		'style' => 'branzel-socialfeed-frontend-style',
		'render_callback' => 'fb_feed_render',
	) );
}
add_action( 'init', 'socialfeed_register' );

function fb_feed_render( $attributes, $content ) {	
	$output = '';
	
	$pageID = '';
	if ( $attributes['pageID'] ) {
		$pageID = $attributes['pageID'];
	}
	
	$feedHeight = '';
	if ( $attributes['feedHeight'] ) {
		$feedHeight = $attributes['feedHeight'];
	}
	
	$output .= '<div id="fb-root"></div><div class="bwfbfeed-container text-center' . ( $attributes['className'] ? " " . $attributes['className'] : '' ) . '">
	<div class="fb-page" data-href="https://www.facebook.com/' . $pageID . '/" data-tabs="timeline" data-width="500" data-height="' . $feedHeight . '" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/' . $pageID . '/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/' . $pageID .'/">BeMSA Gent</a></blockquote></div>
	</div>';
	// $output .= '</div><div class="bwfbfeed-container' . ( $attributes['className'] ? " " . $attributes['className'] : '' ) . '"><div class="social-feed-container container"></div></div>';
    

	// $accessToken = '';
	// if ( $attributes['accessToken'] ) {
		// $accessToken = $attributes['accessToken'];
	// }
	
	// $numPosts = '';
	// if ( $attributes['numPosts'] ) {
		// $numPosts = $attributes['numPosts'];
	// }
    // if(empty($numPosts) || $numPosts=='') {
		// $numPosts ='5';
    // }
	
	// $postLength = '';
	// if ( $attributes['postLength'] ) {
		// $postLength = $attributes['postLength'];
	// }
    // if(empty($postLength) || $postLength=='') {
		// $postLength ='100';
    // }
	
	/*wp_add_inline_script( 'branzel-socialfeed-js', "jQuery(document).ready(function(){jQuery('.social-feed-container').socialfeed({" .
		// FACEBOOK
		"facebook:{ accounts: ['@$pageID'], limit: $numPosts, access_token: '$accessToken' }," . 
		// GENERAL SETTINGS
		"length: $postLength, show_media: true, template_html: '<div class=\"bw-fb-feed-element row mb-3 {{? !it.moderation_passed}}hidden{{?}}\" dt-create=\"{{=it.dt_create}}\" social-feed-id =\"{{=it.id}}\">" . 
			'<div class="col-xs-2 col-sm-2">' . 
				"<a class=\"pull-left profilepic\" href=\"{{=it.author_link}}\" target=\"_blank\"><img class=\"img-thumbnail media-object\" src=\"{{=it.author_picture}}\"></a>".
			'</div><div class="col-xs-10 col-sm-10">' .
				"<p><a href=\"{{=it.author_link}}\" target=\"_blank\">{{=it.author_name}}</a></p><p>{{=it.time_ago}}</p>" . 
			'</div>' . "<div class=\"text-wrapper col-xs-12 col-sm-12\"><p class=\"feed-text\">{{=it.text}} <a href=\"{{=it.link}}\" target=\"_blank\" class=\"btn btn-secondary understrap-read-more-link\">" . __( 'Read More...', 'understrap' ) . "</a></p></div><div class=\"col-xs-12 col-sm-12 text-center\">{{=it.attachment}}</div></div>' }); 
	});" );*/
	
	return $output;
}
