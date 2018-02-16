<?php
/**
 * component news block
 *
 * @package : Gnews-VC
 * @version Gnews-VC 1.0
 */


// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Class Gnews_VC_Component_Block1
 */
class Gnews_VC_Component_Block1 extends Gnews_VC_Component {

	/**
	 * Constructor
	 */
	function __construct() {
		// Posts
		add_filter( "vc_autocomplete_gnews_vc_block1_posts_callback", array( $this, 'post_suggester' ) );
		add_filter( "vc_autocomplete_gnews_vc_block1_posts_render", array( $this, 'post_renderer' ) );
		// Category.
		add_filter( "vc_autocomplete_gnews_vc_block1_category_callback", array( $this, 'category_suggester' ) );
		add_filter( "vc_autocomplete_gnews_vc_block1_category_render", array( $this, 'category_renderer' ) );
		// Tags.
		add_filter( "vc_autocomplete_gnews_vc_block1_tags_callback", array( $this, 'tag_suggester' ) );
		add_filter( "vc_autocomplete_gnews_vc_block1_tags_render", array( $this, 'tag_renderer' ) );

		add_action( 'init', array( $this, 'block1_mapping' ) );
		add_shortcode( 'gnews_vc_block1', array( $this, 'block1_func' ) );
	}

	/**
	 * Add shortcode to Visual Composer content element list
	 */
	public function block1_mapping() {
		vc_map( array(
			'name'                    => esc_html__( 'News Block1', 'gnews-vc' ),
			'base'                    => 'gnews_vc_block1',
			'icon'                    => GNEWS_VC_PLUGIN_URL_VC . 'assets/images/blog_list.png',
			'category'                => esc_html__( 'By Gnews-VC', 'gnews-vc' ),
			'description'             => esc_html__( 'Gnews-VC News Block1', 'gnews-vc' ),
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Widget title', 'gnews-vc' ),
					'param_name'  => 'title',
					'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'gnews-vc' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Show', 'gnews-vc' ),
					'param_name' => 'post_type',
					'value'      => array(
						esc_html__( 'All posts', 'gnews-vc' )           => 'posts',
						esc_html__( 'Recent posts', 'gnews-vc' )        => 'recent_posts',
						esc_html__( 'Posts by categories', 'gnews-vc' ) => 'category',
						esc_html__( 'Posts by tags', 'gnews-vc' )       => 'tags',
					),
					'std'        => 'category',
				),
				// post auto-complete
				array(
					'type'        => 'autocomplete',
					'heading'     => esc_html__( 'Choose posts', 'gnews-vc' ),
					'param_name'  => 'posts',
					'settings'    => array(
						'multiple'   => true,
						'min_length' => 0,
					),
					'save_always' => true,
					'description' => esc_html__( 'Field accept post ID, title. Leave empty to show all posts.', 'gnews-vc' ),
					'dependency'  => array(
						'element' => 'post_type',
						'value'   => 'posts',
					),
				),
				// category auto-complete
				array(
					'type'        => 'autocomplete',
					'heading'     => esc_html__( 'Choose post categories', 'gnews-vc' ),
					'param_name'  => 'category',
					'settings'    => array(
						'multiple'   => true,
						'min_length' => 0,
					),
					'save_always' => true,
					'description' => esc_html__( 'Field accept category ID, title, slug. Leave empty to show all posts.', 'gnews-vc' ),
					'dependency'  => array(
						'element' => 'post_type',
						'value'   => 'category',
					),
				),
				// tags auto-complete
				array(
					'type'        => 'autocomplete',
					'heading'     => esc_html__( 'Choose tags', 'gnews-vc' ),
					'param_name'  => 'tags',
					'settings'    => array(
						'multiple'   => true,
						'min_length' => 0,
					),
					'save_always' => true,
					'description' => esc_html__( 'Field accept tag ID, title, slug. Leave empty to show all posts.', 'gnews-vc' ),
					'dependency'  => array(
						'element' => 'post_type',
						'value'   => 'tags',
					),
				),
				// show featured
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show featured image?', 'gnews-vc' ),
					'param_name'  => 'show_featured',
					// 'description' => esc_html__( 'Show featured image?', 'gnews-vc' ),
					'std'         => 'true',
				),
				// show post type icon
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show post type icon?', 'gnews-vc' ),
					'param_name'  => 'show_post_type_icon',
					// 'description' => esc_html__( 'Show post type icon?', 'gnews-vc' ),
					'std'         => 'true',
				),
				// show post title
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show post title?', 'gnews-vc' ),
					'param_name'  => 'show_post_title',
					// 'description' => esc_html__( 'Show post title?', 'gnews-vc' ),
					'std'         => 'true',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Post title size', 'gnews-vc' ),
					'param_name'  => 'post_title_size',
					'value'       => array(
						'H1' => 'h1',
						'H2' => 'h2',
						'H3' => 'h3',
						'H4' => 'h4',
						'H5' => 'h5',
						'H6' => 'h6',
					),
					'std'         => 'h3',
					'dependency'  => array(
						'element' => 'show_post_title',
						'value'   => 'true',
					),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show underline for post title?', 'gnews-vc' ),
					'param_name'  => 'show_underline_title',
					'std'         => 'true',
					'dependency'  => array(
						'element' => 'show_post_title',
						'value'   => 'true',
					),
				),
				// show post sub title
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show post sub title?', 'gnews-vc' ),
					'param_name'  => 'show_post_sub_title',
					// 'description' => esc_html__( 'Show post sub title?', 'gnews-vc' ),
					'std'         => 'true',
				),
				// show author name
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show author name?', 'gnews-vc' ),
					'param_name'  => 'show_author_name',
					// 'description' => esc_html__( 'Show author name?', 'gnews-vc' ),
					'std'         => 'true',
				),
				// show comments
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show comments?', 'gnews-vc' ),
					'param_name'  => 'show_comments',
					// 'description' => esc_html__( 'Show comments?', 'gnews-vc' ),
					'std'         => 'true',
				),
				// show related posts
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show related posts?', 'gnews-vc' ),
					'param_name'  => 'show_related_posts',
					// 'description' => esc_html__( 'Show related posts?', 'gnews-vc' ),
					'std'         => 'true',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Number of related posts', 'gnews-vc' ),
					'param_name'  => 'related_posts',
					'value'       => esc_html__( '0', 'gnews-vc' ),
					'description' => esc_html__( 'Max value is 3.', 'gnews-vc' ),
					'dependency'  => array(
						'element' => 'show_related_posts',
						'value'   => 'true',
					),
				),
				// extra class
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'gnews-vc' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gnews-vc' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'gnews-vc' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'gnews-vc' ),
				),
			),
		) );
	}

	/**
	 * Shortcode mapper
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public function block1_func( $atts = array(), $content = '' ) {

		// default attributes
		extract( shortcode_atts( array(
			'title'                  => '',
			'post_type'              => 'category',
			'posts'                  => '',
			'tags'                   => '',
			'category'               => '',
			'show_featured'          => 'true',
			'show_post_type_icon'    => 'true',
			'show_post_title'        => 'true',
			'post_title_size'        => 'h3',
			'show_underline_title'   => 'true',
			'show_post_sub_title'    => 'true',
			'show_author_name'       => 'true',
			'show_comments'          => 'true',
			'show_related_posts'     => 'true',
			'related_posts'          => '0',
			'el_class'               => '',
		), $atts ) );

		$block_id               = 'gnews-block-' . mt_rand();
		$post_type              = isset( $atts['post_type'] ) ? $atts['post_type'] : 'category';
		$posts                  = isset( $atts['posts'] ) ? $atts['posts'] : '';
		$tags                   = isset( $atts['tags'] ) ? $atts['tags'] : '';
		$category               = isset( $atts['category'] ) ? $atts['category'] : '';		
		$show_featured          = isset( $atts['show_featured'] ) ? $atts['show_featured'] : 'true';
		$show_post_type_icon    = isset( $atts['show_post_type_icon'] ) ? $atts['show_post_type_icon'] : 'true';
		$show_post_title        = isset( $atts['show_post_title'] ) ? $atts['show_post_title'] : 'true';
		$post_title_size        = isset( $atts['post_title_size'] ) ? $atts['post_title_size'] : 'h3';
		$show_underline_title   = isset( $atts['show_underline_title'] ) ? $atts['show_underline_title'] : 'true';
		$show_post_sub_title    = isset( $atts['show_post_sub_title'] ) ? $atts['show_post_sub_title'] : 'true';
		$show_author_name       = isset( $atts['show_author_name'] ) ? $atts['show_author_name'] : 'true';
		$show_comments          = isset( $atts['show_comments'] ) ? $atts['show_comments'] : 'true';
		$show_related_posts     = isset( $atts['show_related_posts'] ) ? $atts['show_related_posts'] : '0';
		$related_posts          = isset( $atts['related_posts'] ) ? $atts['related_posts'] : 'true';

		$css = isset( $atts['css'] ) ? $atts['css'] : '';

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );

		// query
		switch ( $post_type ) {
			case 'posts':
				$query = $this->get_posts_by_post_type( 'post', $posts );
				break;
			case 'recent_posts':
				$query = $this->get_posts_by_post_type( 'post', array() );
				break;
			case 'tags':
				$query = $this->get_posts_by_taxonomy( 'post', 'post_tag', $tags );
				break;
			case 'category':
				$category_terms = array_map( 'trim', explode( ',', $category ) );
				$category_field = ( is_numeric( $category_terms[0] ) ? 'term_id' : 'slug' );

				$query = $this->get_posts_by_taxonomy( 'post', 'category', $category_terms, $category_field );
				break;
		}

		// get total number of post from input posts
		$post_total = 1;
		if ( $posts ) {
			$pieces       = explode( ",", $posts );
			$count_pieces = count( $pieces );
			if ( $count_pieces > 0 ) {
				$post_total = $count_pieces;
			}
		}

		$html = '';

		if ( isset( $atts['title'] ) && strlen( $atts['title'] ) ) {
			$html = '<h2>' . esc_html( $atts['title'] ) . '</h2>';
		}

		$html .= '<div class="gnews-block' . esc_attr( $css_class );

		if ( isset( $atts['el_class'] ) && strlen( $atts['el_class'] ) ) {
			$html .= ' ' . esc_attr( $atts['el_class'] );
		}

		$html .= '" id="' . esc_attr( $block_id ) . '">';

		//--> body
		$count = 0;
		while ( $query->have_posts() ) {
			// check limit
			if ( $count >= $post_total ) {
				break;
			}

			$query->the_post();

			//--> start building
			$post_id = get_the_ID();
			$post_link = get_permalink();

			// featured image
			if ( $show_featured == 'true' ) {
				$post_thumb = get_the_post_thumbnail_url( $post_id, 'full' );
				
				if( $post_thumb ) {
					$thumbnail_id = get_post_thumbnail_id( $post_id );
					$thumbnail_alt = '';
					if ( $thumbnail_id ) {
						$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
					} else {
						$thumbnail_alt = wp_basename( $post_thumb );
					}

					$html .= '<a href="' . $post_link . '"><img class="img-responsive" src="' . esc_url( $post_thumb ) . '" alt="' . esc_attr( $thumbnail_alt ) . '"></a>';
				}
			}

			// show title
			if ( $show_post_title == 'true' ) {
				$title_underline_class = $show_underline_title == 'true' ? 'gnews-title-underline' : '';
				$html .= '<' . $post_title_size . ' class="gnews-title' . $title_underline_class . '"><a href="' . $post_link . '">' . get_the_title() . '</a></' . $post_title_size . '>';
			}

			// show sub title
			if ( $show_post_sub_title == 'true' ) {				
			}
			
			// show author
			if ( $show_author_name == 'true' ) {
				$html .= '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">' . get_author_name() . '</a>';
			}

			// show comments
			if ( $show_comments == 'true' ) {
				$post_comments = get_comments_number();
				$html .= '<a href="' . $post_link . '">' . esc_attr( $post_comments ) . '</a>';
			}

			// show related posts
			if ( $show_related_posts == 'true' ) {
				$html .= '<a href="' . $post_link . '">' . esc_attr( $post_comments ) . '</a>';
			}
			

			// // post count
			// $post_count = get_post_meta( $post_id, 'gnews_post_views_count', true );
			// if ( $post_count == '' ) {
			// 	$post_count = 1;
			// 	delete_post_meta( $post_id, 'gnews_post_views_count' );
			// 	add_post_meta( $post_id, 'gnews_post_views_count', $post_count );
			// } else {
			// 	$post_count++;
			// 	update_post_meta( $post_id, 'gnews_post_views_count', $post_count );
			// }

			$count ++;
		}

		wp_reset_postdata();
		//<-- body

		$html .= '</div>';

		return $html;
	}

	/**
	 * @param string $query
	 *
	 * @return array
	 */
	public function post_suggester( $query = '' ) {
		global $wpdb;

		$query = stripslashes( trim( $query ) );

		//--> prepare query to remove sticky posts
		$sticky_posts               = get_option( 'sticky_posts' );
		$query_exclude_sticky_posts = '';
		if ( $sticky_posts ) {
			$query_exclude_sticky_posts = " ID NOT IN ( '" . implode( $sticky_posts, "', '" ) . "' ) AND ";
		}
		//<-- prepare query to remove sticky posts

		if ( $query ) {
			$post_id  = absint( $query );
			$post_id  = ( $post_id > 0 ? $post_id : - 1 );
			$db_query = $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->posts} WHERE {$query_exclude_sticky_posts} post_type = 'post' AND post_status = 'publish' AND (ID = '%d' OR post_title LIKE '%%%s%%' OR post_name LIKE '%%%s%%') LIMIT 20", $post_id, $query, strtolower( $query ) );
		} else {
			$db_query = "SELECT ID, post_title FROM {$wpdb->posts} WHERE {$query_exclude_sticky_posts} post_type = 'post' AND post_status = 'publish' LIMIT 20";
		}

		$posts = $wpdb->get_results( $db_query, ARRAY_A );

		if ( empty( $posts ) || ! is_array( $posts ) ) {
			return array();
		}

		$result = array();

		foreach ( $posts as $post ) {
			$result[] = array(
				'value' => $post['ID'],
				'label' => sprintf( 'Id: %1$s - Title: %2$s', $post['ID'], $post['post_title'] ),
			);
		}

		return $result;
	}

	/**
	 * @param $entry
	 *
	 * @return array|bool
	 */
	public function post_renderer( $entry = array() ) {
		$post_id = $entry['value'];
		$post    = get_post( $post_id, OBJECT );

		if ( ! $post ) {
			return false;
		}

		return array(
			'label' => sprintf( 'Id: %1$s - Title: %2$s', $post->ID, $post->post_title ),
			'value' => $post->ID,
		);
	}

	/**
	 * @param string $query
	 *
	 * @return array
	 */
	public function category_suggester( $query = '' ) {
		global $wpdb;

		$query = stripslashes( trim( $query ) );

		if ( $query ) {
			$cat_id   = absint( $query );
			$cat_id   = ( $cat_id > 0 ? $cat_id : - 1 );
			$db_query = $wpdb->prepare( "SELECT a.term_id AS id, b.name AS name, b.slug AS slug FROM {$wpdb->term_taxonomy} AS a INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id WHERE a.taxonomy = 'category' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%') LIMIT 20", $cat_id, $query, $query );
		} else {
			$db_query = "SELECT a.term_id AS id, b.name AS name, b.slug AS slug FROM {$wpdb->term_taxonomy} AS a INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id WHERE a.taxonomy = 'category' LIMIT 20";
		}

		$terms = $wpdb->get_results( $db_query, ARRAY_A );

		if ( empty( $terms ) || ! is_array( $terms ) ) {
			return array();
		}

		$result = array();

		foreach ( $terms as $value ) {
			$result[] = array(
				'value' => $value['id'],
				'label' => sprintf( 'Id: %1$s - Name: %2$s - Slug: %3$s', $value['id'], $value['name'], $value['slug'] ),
			);
		}

		return $result;
	}

	/**
	 * @param array $entry
	 *
	 * @return array|bool
	 */
	public function category_renderer( $entry = array() ) {
		$value = $entry['value'];
		$field = 'id';

		// Query by slug for compatibility.
		if ( ! is_numeric( $value ) ) {
			$field = 'slug';
		}

		$term = get_term_by( $field, $value, 'category', OBJECT );

		if ( ! $term ) {
			return false;
		}

		return array(
			'label' => sprintf( 'Id: %1$s - Name: %2$s - Slug: %3$s', $term->term_id, $term->name, $term->slug ),
			'value' => $term->term_id,
		);
	}

	/**
	 * @param string $query
	 *
	 * @return array
	 */
	public function tag_suggester( $query = '' ) {
		global $wpdb;

		$query = stripslashes( trim( $query ) );

		if ( $query ) {
			$cat_id   = absint( $query );
			$cat_id   = ( $cat_id > 0 ? $cat_id : - 1 );
			$db_query = $wpdb->prepare( "SELECT a.term_id AS id, b.name AS name, b.slug AS slug FROM {$wpdb->term_taxonomy} AS a INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id WHERE a.taxonomy = 'post_tag' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%') LIMIT 20", $cat_id, $query, $query );
		} else {
			$db_query = "SELECT a.term_id AS id, b.name AS name, b.slug AS slug FROM {$wpdb->term_taxonomy} AS a INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id WHERE a.taxonomy = 'post_tag' LIMIT 20";
		}

		$terms = $wpdb->get_results( $db_query, ARRAY_A );

		if ( empty( $terms ) || ! is_array( $terms ) ) {
			return array();
		}

		$result = array();

		foreach ( $terms as $value ) {
			$result[] = array(
				'value' => $value['id'],
				'label' => sprintf( 'Id: %1$s - Name: %2$s - Slug: %3$s', $value['id'], $value['name'], $value['slug'] ),
			);
		}

		return $result;
	}

	/**
	 * @param array $entry
	 *
	 * @return array|bool
	 */
	public function tag_renderer( $entry = array() ) {
		$value = $entry['value'];
		$field = 'id';

		// Query by slug for compatibility.
		if ( ! is_numeric( $value ) ) {
			$field = 'slug';
		}

		$term = get_term_by( $field, $value, 'post_tag', OBJECT );

		if ( ! $term ) {
			return false;
		}

		return array(
			'label' => sprintf( 'Id: %1$s - Name: %2$s - Slug: %3$s', $term->term_id, $term->name, $term->slug ),
			'value' => $term->term_id,
		);
	}

	/**
	 * @param string $post_type
	 * @param array  $post_ids
	 *
	 * @return WP_Query
	 */
	protected function get_posts_by_post_type( $post_type = '', $post_ids = array() ) {
		if ( is_string( $post_ids ) ) {
			$post_ids = array_map( 'trim', explode( ',', $post_ids ) );
		}
		$post_ids = array_filter( $post_ids );

		$query_args = array(
			'orderby'          => 'date',
			'order'            => 'desc',
			'posts_per_page'   => - 1,
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'paged'            => 1,
			'suppress_filters' => false,
			'post__in'         => $post_ids,
			'post__not_in'     => get_option( 'sticky_posts' ),
		);

		return new WP_Query( $query_args );
	}

	/**
	 * @param string $post_type
	 * @param string $taxonomy
	 * @param array  $taxonomy_terms
	 * @param string $taxonomy_field
	 *
	 * @return WP_Query
	 */
	protected function get_posts_by_taxonomy( $post_type = '', $taxonomy = '', $taxonomy_terms = array(), $taxonomy_field = 'term_id' ) {

		if ( is_string( $taxonomy_terms ) ) {
			$taxonomy_terms = array_map( 'trim', explode( ',', $taxonomy_terms ) );
		}
		$taxonomy_terms = array_filter( $taxonomy_terms );

		$query_args = array(
			'posts_per_page'   => - 1,
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'suppress_filters' => false,
			'orderby'          => 'date',
			'order'            => 'desc',
			'paged'            => 1,
			'post__not_in'     => get_option( 'sticky_posts' ),
		);

		$tax_query = array();
		if ( $taxonomy_terms ) {
			$tax_query = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => $taxonomy_field,
					'terms'    => $taxonomy_terms,
				),
			);
		}

		if ( $tax_query ) {
			$query_args['tax_query'] = $tax_query;
		}

		return new WP_Query( $query_args );
	}
}

// Initialize
new Gnews_VC_Component_Block1;