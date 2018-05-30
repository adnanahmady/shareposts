<?php
function create_item($link_address, $link_title) {
    echo '<li class="nav-item ', ($_SERVER['REQUEST_URI'] == $link_address ? 'active' : ''), '">
        <a class="nav-link" href="', APPURL, $link_address, '">', $link_title;
          if ( $_SERVER['REQUEST_URI'] == $link_address ) {
              echo '<span class="sr-only">(current)</span>';
          }
    echo '</a></li>';
}