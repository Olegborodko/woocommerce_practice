<?php

function print_deals_with_files_db ( $deals_with_files, $deals_with_db, $size='' ) {
    $deals_with_files   ? print_files_in_red ( $size )  : print_files_in_gray ( $size );
    $deals_with_db      ? print_db_in_red ( $size )     : print_db_in_gray ( $size );
}
function print_files_in_gray ( $size='' ) {
    echo '<img src="' . AWR_PLUGIN_IMG_URL . '/gray-file-icon' . $size . '.svg" alt="gray-file-icon' . $size . '" title="This tool does not alter your files.">';    
}
function print_files_in_red ( $size='' ) {
    echo '<img src="' . AWR_PLUGIN_IMG_URL . '/red-file-icon' . $size . '.svg" alt="red-file-icon' . $size . '" title="This tool may delete files.">';    
}
function print_db_in_gray ( $size='' ) {
    echo '<img src="' . AWR_PLUGIN_IMG_URL . '/gray-db-icon' . $size . '.svg" alt="gray-db-icon' . $size . '" title="This tool will not alter data in your database.">';
}
function print_db_in_red ( $size='' ) {
    echo '<img src="' . AWR_PLUGIN_IMG_URL . '/red-db-icon' . $size . '.svg" alt="red-db-icon' . $size . '" title="This tool may alter data in your database.">';
}
