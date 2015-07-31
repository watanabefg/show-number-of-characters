<?php
/*
    Plugin Name: Show Nuber of characters
    Plugin URI: http://web.pules.jp/wp-plugin-show-number-of-characters/
    Description: This is to display the number of characters in the post list screen
    Author: Hironori Watanabe
    Author URI: http://web.pules.jp/
    Version: 0.1
*/

/*  Copyright 2015 Hironori Watanabe (email: info+wpplugins at pules.jp)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/* 投稿一覧, 固定ページ一覧にサムネイル, 文字数を追加 */
function add_posts_columns($columns) {
  $columns['thumbnail'] = __('サムネイル');
  $columns['count'] = __('文字数');
  echo '<style TYPE="text/css">.column-thumbnail img {max-width:100%; height:auto;}</style>';
  return $columns;
}

function add_posts_columns_row($column_name,  $post_id) {
  switch ($column_name) {
  case 'thumbnail':
    $thumb = get_the_post_thumbnail($post_id,  array(100, 100),  'thumbnail');
    echo ($thumb) ? $thumb : '－';
    break;
  case 'count':
    $count = mb_strlen(strip_tags(get_post_field('post_content',  $post_id)));
    echo $count;
    break;
  }
}

// 投稿一覧用
add_filter( 'manage_posts_columns',  'add_posts_columns' );
add_action( 'manage_posts_custom_column',  'add_posts_columns_row',  10,  1 );

// 固定ページ一覧用
add_filter( 'manage_pages_columns',  'add_posts_columns' );
add_action( 'manage_pages_custom_column',  'add_posts_columns_row',  10,  1 );
