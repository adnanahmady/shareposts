<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 28/02/2018
 * Time: 02:23 PM
 */

class Pages extends Controller
{
    public function __construct() { }

    public function index() {

        if ( userLoggedIn() ) {
            redirect( 'posts/index' );
        }

        $data   = [
            'title' => 'Share Posts',
            'description'   => 'Simple social network built on the testMVC PHP framwork'
        ];

        return $this->view('public/index', $data);
    }

    public function about() {
        $data   = [
            'title' => 'About Us',
            'description'   => 'App to share posts with other peaple.'
        ];

        return $this->view('public/about', $data);
    }
}