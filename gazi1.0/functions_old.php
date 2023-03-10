<?php

/*te functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * @package 	WordPress
	 * @subpackage 	Abraham Lincoln
	 * @since 		Abraham Lincoln 0.1.0
	 */

	/* ========================================================================================================================

	Required external files

	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );


	/* ========================================================================================================================

	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme

	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	function abraham_display_author($uppercase = true) {
		echo abraham_get_author($uppercase);
	}

	//script for hover over categories to trigger
	//dropdown of top stories in that catogory
function createCollapseElement($categoryId){
		?>
		<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function() {
				$('.category-heading-<?php echo $categoryId ?>').hover(
				//on mouse hover, slide down
				 function() {
						$('#dropdown-<?php echo $categoryId ?>').slideDown();
					},
				//when mouse leaves div, slide up
					function() {
						setTimeout(function(){
						    $('#dropdown-<?php echo $categoryId ?>').slideUp();
						  }, 1500);
					}
				);
			});
		</script>
		<?php
	}

  function twitter_feed($withCol = true) {
    if($withCol) {
      echo '<div class="col-sm-3">';
    }
  ?>
          <div class="box category-heading-twitter">
            <h2 style = "height: 55px; padding: 20px;">Twitter</h2>
						<div class = "collapse category-heading-twitter" id = "dropdown-twitter">
            <a class="twitter-timeline" href="https://twitter.com/wesleyanargus" data-widget-id="559476995713937408">Tweets by @wesleyanargus</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
				  </div>
        </div>

<?php
createCollapseElement('twitter');
if($withCol) {
echo '</div>';
}


}
	function abraham_get_photo($post, $size, $arg2='', $arg3='', $arg4=true) {
		if (has_post_thumbnail($post->ID)) {
			return wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0];
		}
		return arg_photo($post,$size,$arg2,$arg3,$arg4);
	}
	function abraham_get_author($uppercase = true) {
		if ($uppercase) {
			$b = 'B';
		} else {
			$b = 'b';
		}
		global $post;
                $authors = get_post_meta($post->ID, '_arg_author', false);
		$positions = get_post_meta($post->ID, '_arg_byline_sub', false);
		foreach ($authors as $author_str) {
			if (!is_array($author_str)) {
				$author = json_decode($author_str);
				if (!isset($firstAuthor)) {
					$byline = $byline . $author->{'name'};
					$firstAuthor = $author->{'username'};
				} else {
					$byline = $byline . ', ' . $author->{'name'};
				}
			} else {
				foreach ($author_str as $author_id) {
					$author = get_user_by('id', $author_id);
					$name = $author->first_name . ' ' . $author->last_name;
					if (strlen($name) < 2) {
						$name = $author->nickname;
					}
					if (!isset($firstAuthor)) {
						$byline = $byline . $name;
						$firstAuthor = $author->user_login;
					} else {
						$byline = $byline . ', ' . $name;
					}
				}
			}
		}
                if (count($positions) > 0 ) {
                        $byline = $byline . ', ' . $positions[0];
                }
	        return '<a href="/user/' . $firstAuthor . '/">' . $b.'y ' . $byline . "</a>";

	}

    function abraham_excerpt($id=false) {
        global $post;

        $old_post = $post;
        if ($id != $post->ID) {
            $post = get_page($id);
        }

        if (!$excerpt = trim($post->post_excerpt)) {
            $excerpt = $post->post_content;
            $excerpt = strip_shortcodes( $excerpt );
            $excerpt = apply_filters('the_content', $excerpt);
            $excerpt = str_replace(']]>', ']]>', $excerpt);
            $excerpt = strip_tags($excerpt);
            $excerpt_length = apply_filters('excerpt_length', 55);
            $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');

            $words = preg_split("/[\n\r\t ]+/", $excerpt, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
            if ( count($words) > $excerpt_length ) {
                array_pop($words);
                $excerpt = implode(' ', $words);
                $excerpt = $excerpt . $excerpt_more;
            } else {
                $excerpt = implode(' ', $words);
            }
        }

        $post = $old_post;

        return $excerpt;
    }


    function panoptes_display_author_archive_post() {
        global $post;
        ?>
            <div>
                <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                <?php
                    abraham_display_author();
                    abraham_display_time();
                    ?>
                    <!-- user page abraham -->
                        <p><?php the_excerpt(); ?></p>
                    <?php
                 wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) );
                 ?>
            </div>
        <?php
    }
	// register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================

	Actions and Filters

	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================

	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

	======================================================================================================================== */



	/* ========================================================================================================================

	Scripts

	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}

	/* ========================================================================================================================

	Comments

	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}

    // borrowed from http://snipplr.com/view/8480/a-php-function-to-return-the-first-n-words-from-a-string/
    function shorten_string($string, $wordsreturned) {
        $retval = $string;  //  Just in case of a problem
        $array = explode(" ", $string);
        /*  Already short enough, return the whole thing*/
        if (count($array)<=$wordsreturned)
        {
            $retval = $string;
        }
        /*  Need to chop of some words*/
        else
        {
            array_splice($array, $wordsreturned);
            $retval = implode(" ", $array)." ...";
        }
        return $retval;
    }
	?>

