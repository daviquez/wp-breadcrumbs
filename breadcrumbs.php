<?php 
/** 
 * Function to get the breadcrumbs
 * Version: 0.0.1
 * &#62;: This is the > symbol
*/

function _themename_get_breadcrumbs() {
    // THE GLOBAL POST
    global $post;
    // Gets the ancestors
    $ancestors = get_post_ancestors();
    // Sorts the ancestors
    krsort($ancestors);

    // Displays Home > and its URL in the begining 
    echo '<a href="'.home_url('/').'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        // If it is category or single
        echo "&nbsp;&nbsp;&#62;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#62;&nbsp;&nbsp; ";
                the_title();
            }
        } elseif (is_page() && $post->post_parent){
        // If the post has parents
        // Displays the name and the link for each ancestor of the post after the > symbol
        foreach ($ancestors as $ancestor) {
            echo "&nbsp;&nbsp;&#62;&nbsp;&nbsp;";
            echo '<a href='. get_the_permalink($ancestor) .'>'.get_the_title($ancestor).'</a>';
        }
        echo "&nbsp;&nbsp;&#62;&nbsp;&nbsp;";
        echo the_title();
    }elseif (is_page()) {
        // If the post has no parents
        echo "&nbsp;&nbsp;&#62;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        // In case of a search
        echo "&nbsp;&nbsp;&#62;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}