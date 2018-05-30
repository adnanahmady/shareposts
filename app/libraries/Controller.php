<?php

class Controller {

    // instanssiate Methods
    public function model( $model ) {
        if ( file_exists( APPROOT . '/models/'. ucwords( $model ) . '.php' ) ) {
            require_once APPROOT . '/models/' . ucwords($model) . '.php';
            return new $model();
        }
    }

     public function view( $view, $data = [] ) {
        if ( file_exists( '../app/views/' . $view . '.php' ) ) {
            require_once APPROOT . '/views/' . $view . '.php';
        } else {
            die('View does not exists');
        }
     }
}