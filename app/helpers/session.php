<?php
session_start();

function userLoggedIn() {
    if ( isset( $_SESSION[ 'user_id' ]) ) {
        return true;
    } else { return false; }
}

function setSessionUser( $user ) {
    $_SESSION[ 'user_id' ]      = $user->id;
    $_SESSION[ 'user_name' ]    = $user->username;
    $_SESSION[ 'user_email' ]   = $user->email;
    redirect( 'posts/index' );
}

function msg ( $name = '', $message = '', $class = 'alert alert-success' ) {

    if ( ! empty ( $name ) ) {
        if ( ! empty ( $message ) && empty ( $_SESSION[$name] ) ) {
            if ( ! empty ( $_SESSION[ $name ] ) ) {
                unset ( $_SESSION[ $name ] );
            }

            if ( ! empty ( $_SESSION[ $name . '_class' ] ) ) {
                unset ( $_SESSION[ $name . '_class' ] );
            }

            $_SESSION[ $name ] = $message;
            $_SESSION[ $name . '_class' ] = $class;
        } elseif ( empty( $message ) && !empty( $_SESSION[ $name ] ) ) {
            $class = ! empty ( $_SESSION[ $name . '_class'] ) ? $_SESSION[ $name . '_class' ] : '';
            echo '<div class="' . $_SESSION[ $name . '_class' ] . '" id="msg-alert">' . $_SESSION[ $name ] . '</div>';
            unset( $_SESSION[ $name ] );
            unset( $_SESSION[ $name . '_class'] );
        }
    }
}