<?php
/**
 * The template for sidebar.
 *
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Abraham Lincoln
 * @since 		Abraham Lincoln 0.1.0
 */

/*
<div class="box">
                <h2>Media</h2>
                <?php
                  $args = array(
                    'numberposts' => '3',
                    'category' => 89,
                    'orderby' => 'post_date',
                    'order' => 'DESC'
                  );
                  $recent_posts = get_posts( $args );
                  $count = 0;
                  foreach( $recent_posts as $post ){
                    if($count == 0) {
                      echo "<img src='". abraham_get_photo($post, 155, '', '', true)  . "'>";
                      echo "<ul>";
                    }
                    echo '<li><a href="' . get_permalink() . '" title="Look '.get_the_title().'" ><strong>' .   get_the_title().'</strong></a>' . abraham_get_author(true) . '</li> ';
                    $count++;
                  }
                ?>
               
              </div>
*/

?>

            
              

              <?php twitter_feed(false); ?>
              

