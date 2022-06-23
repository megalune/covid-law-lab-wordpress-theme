<?php

function getjregion_function() {
    $jregion = get_the_category();
    $separator = ' ';
    $output = '';
    $cats = array(1, 41, 348, 429, 518);
    if ($jregion) {
        foreach ($jregion as $category)
            if (in_array($category->cat_ID, $cats)) {
                $output .= '<a href="' . get_category_link($category->term_id) . '" title="' . esc_attr(sprintf(__("View all judgments in %s"), $category->name)) . '">' . $category->cat_name . '</a>' . $separator;
            }
        return trim($output, $separator);
    }
}

function getjbodies_function() {
    $jbodies = get_the_category();
    $separator = ' ';
    $output = '';
    $bodies = array(426, 599);
    if ($jbodies) {
        foreach ($jbodies as $category)
            if (in_array($category->category_parent, $bodies)) {
                $output .= '<a href="' . get_category_link($category->term_id) . '" title="' . esc_attr(sprintf(__("View all judgments in %s"), $category->name)) . '">' . $category->cat_name . '</a>' . $separator;
            }
        return trim($output, $separator);
    }
}

function getjcountry_function() {
    $jcountry = get_the_category();
    $separator = ', ';
    $output = '';
    $country = array(1, 41, 348, 429, 518);
    $and = '<b>Country</b>:';
    if ($jcountry) {
        foreach ($jcountry as $category)
            if (in_array($category->category_parent, $country)) {
                $output .= '<a href="' . get_category_link($category->term_id) . '" title="' . esc_attr(sprintf(__("View all judgments in %s"), $category->name)) . '">' . $category->cat_name . '</a>' . $separator;
            }
        $tr = trim($output, $separator);   
        $tr = $and . ' ' . $tr . '<br>';
        return $tr;
    }
}

function getjhealth_function() {
    $jhealth = get_the_category();
    $separator = ', ';
    $output = '';
    $and = '<b>Health Topics</b>:';
    if ($jhealth) {
        foreach ($jhealth as $ht)
            if ($ht->parent == 34) {
                $output .= '<a href="' . get_category_link($ht->term_id) . '" title="' . esc_attr(sprintf(__("View all judgments in %s"), $ht->name)) . '">' . $ht->cat_name . '</a>' . $separator;
            }
            
        if (!empty($output)) {
            $tr = trim($output, $separator);
            $tr = $and . ' ' . $tr . '<br>';
            return($tr);
        }
    }
}

// function getjrights_function() {
// $jrights = get_the_category();
// $separator = ', ';
// $output = '';
// if($jrights){
// foreach($jrights as $ht)  if($ht->parent == 39){
// $output .= '<a href="'.get_category_link($ht->term_id ).'" title="' . esc_attr( sprintf( __( "View all judgments in %s" ), $ht->name ) ) . '">'.$ht->cat_name.'</a>'.$separator;
// }
// return trim($output, $separator);
// }
// }
// --------------- Older Version

function getjrights_function() {
    $jrights = get_the_category();
    $separator = ', ';
    $output = '';
    $and = '<b>Human Rights:</b>';
    $tr = ' ';
    if ($jrights) {
        foreach ($jrights as $hr)
            if ($hr->parent == 39) {
                $output .= '<a href="' . get_category_link($hr->term_id) . '" title="' . esc_attr(sprintf(__("View all judgments in %s"), $hr->name)) . '">' . $hr->cat_name . '</a>' . $separator;
            }
        if (!empty($output)) {
            $tr = trim($output, $separator);
            $tr = $and . ' ' . $tr . '<br>';
            return($tr);
        }
    }
}

function getjtags_function() {
    $jtags = get_the_tags();
    $separator = ', ';
    $output = '';
    $and = '<b>Tags:</b>';
    $tr = ' ';   
    if ($jtags) {
        foreach ($jtags as $jtag)
                $output .= '<a href="' . get_tag_link($jtag->term_id) . '" title="' . esc_attr(sprintf(__("View all judgments in %s"), $jtag->name)) . '">' . $jtag->name . '</a>' . $separator;
        if (!empty($output)) {
            $tr = trim($output, $separator);
            $tr = $and . ' ' . $tr . '<br>';
            return($tr);
        }
    }
}

function getiregion_function() {
    $taxonomy = 'instruments';
    $terms = get_the_terms($post->ID, $taxonomy);
    $separator = ', ';
    $output = '';
    if ($terms) {
        foreach ($terms as $term)
            if ($term->parent == 789) {
                $link = get_term_link($term, $taxonomy);
                $output .= '<a href="' . $link . '" rel="tag">' . $term->name . '</a>' . $separator;
            }

        return trim($output, $separator);
    }
}

function getilegal_function() {
    $taxonomy = 'instruments';
    $terms = get_the_terms($post->ID, $taxonomy);
    $separator = ', ';
    $output = '';
    if ($terms) {
        foreach ($terms as $term)
            if ($term->parent == 790) {
                $link = get_term_link($term, $taxonomy);
                $output .= '<a href="' . $link . '" rel="tag">' . $term->name . '</a>' . $separator;
            }

        return trim($output, $separator);
    }
}

function getcregion_function() {
    $taxonomy = 'constitutions';
    $terms = get_the_terms($post->ID, $taxonomy);
    $separator = ', ';
    $output = '';
    if ($terms) {
        foreach ($terms as $term)
            if ($term->parent == 795) {
                $link = get_term_link($term, $taxonomy);
                $output .= '<a href="' . $link . '" rel="tag">' . $term->name . '</a>' . $separator;
            }

        return trim($output, $separator);
    }
}

function getcrights_function() {

    $taxonomy = 'constitutions';
    $terms = get_the_terms($post->ID, $taxonomy);
    $separator = ', ';
    $output = '';
    if ($terms) {
        foreach ($terms as $term)
            if ($term->parent == 796) {
                $link = get_term_link($term, $taxonomy);
                $output .= '<a href="' . $link . '" rel="tag">' . $term->name . '</a>' . $separator;
            }

        return trim($output, $separator);
    }
}

function register_shortcodes() {

    add_shortcode('get-rights', 'getjrights_function');

    add_shortcode('get-health', 'getjhealth_function');

    add_shortcode('get-region', 'getjregion_function');

    add_shortcode('get-country', 'getjcountry_function');

    add_shortcode('get-bodies', 'getjbodies_function');

    add_shortcode('get-iregion', 'getiregion_function');
    
    add_shortcode('get-tags', 'getjtags_function');

    add_shortcode('get-ilegal', 'getilegal_function');

    add_shortcode('get-cregion', 'getcregion_function');

    add_shortcode('get-crights', 'getcrights_function');    
}

add_action('init', 'register_shortcodes');
?>