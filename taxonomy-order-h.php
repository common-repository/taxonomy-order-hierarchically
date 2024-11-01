<?php
/**
* Plugin Name: Taxonomy Order Hierarchically
* Description: Will change the order logic for taxonomies from alphabetical to hierarchical order. Sets Taxonomy Hierarchically. This plugin adds a hook to the 'get_the_terms' filter.
* Version: 1.0
* Author: Marek Pietkiewicz
* License: GPLv2 or later
**/

function toh_transform_get_the_terms( $terms ){
    $res = [];
    for( $i = 0, $len = count( $terms ); $i < $len; $i++ ){
        //push parents at the begining
        if( $terms[$i]->parent == 0 ){
            array_unshift( $res, $terms[$i] );
        }
        //push childs at the end
        if( $terms[$i]->parent > 0 ){
            array_push( $res, $terms[$i] );
        }
    }
    return $res;
}

add_filter( 'get_the_terms', 'toh_transform_get_the_terms', 10, 1 );
