<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 02/03/2018
 * Time: 04:24 PM
 */

class Posts extends Controller
{

    public function __construct() {

        /**
         * Redirect if user is not logged in
         */
        if ( ! userLoggedIn() ) {
            redirect('users/login' );
        }

        /**
         * Create model for posts
         */
        $this->postModel = $this->model( 'Post' );
        $this->userModel = $this->model( 'User' );

    }

    public function show( $id ) {

            $post = $this->postModel->showPost( $id );
            $user = $this->userModel->getUserById( $post->user_id );


            $data = [
                'title'         => 'Show Post',
                'post'          => $post,
                'user'          => $user
            ];

            return $this->view( '/posts/show', $data );

    }

    public function delete($id) {

        if ( $_SERVER[ 'REQUEST_METHOD'] == 'POST' ) {

            $post = $this->postModel->getPostById( $id );

            if ( ! userLoggedIn() || $_SESSION[ 'user_id' ] != $post->user_id ) {
                redirect( 'posts' );
            }

            $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

            if ( $this->postModel->deletePost( $id ) ) {
                msg( 'post_added', 'Post Currently Deleted');
                redirect('posts' );
            } else {
                msg( 'post_added', 'Post Couldn\'t be Delete', 'alert alert-danger');
                redirect( 'posts/index' );
            }
        } else {
            msg( 'post_added', 'You have no permission for Deleting this post', 'alert alert-danger mb-0');
            redirect( 'posts/index' ) ;
        }
    }
    public function edit($id) {

        $post = $this->postModel->getPostById( $id );

        if ( ! userLoggedIn() || $_SESSION[ 'user_id' ] != $post->user_id ) {
            redirect( 'posts' );
        }

        $data = [
            'id'                => $id,
            'title'             => 'Edit this Post',
            'user_id'           => $_SESSION['user_id'],
            'post_title'        => $post->title,
            'post_body'         => $post->body,
            'post_title_err'    => '',
            'post_body_err'     => '',
        ];

        if ( $_SERVER[ 'REQUEST_METHOD'] == 'POST' ) {

            $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

            foreach ( $data as $key => $value ) {
                if ( strpos( $key, '_err' ) === false && isset($_POST[ $key ])) {
                    if ( empty( $_POST[ $key ] ) ) {
                        $data[$key . '_err'] = $key . ' couldn\'t be empty';
                    } else {
                        $data[$key] = $_POST[$key];
                    }
                }
            }

            if ( empty( $data[ 'post_title_err' ] ) && empty( $data[ 'post_body_err' ] ) ) {
                // edit post

                if ( $this->postModel->editPost( $data ) ) {
                    msg( 'post_added', 'Post Currently Edited');
                    redirect('posts/index' );
                } else {
                    return $this->view( '/posts/edit', $data);
                }
            } else {
                return $this->view( '/posts/edit', $data);
            }
        } else {
            return $this->view('/posts/edit', $data);
        }
    }

    public function add() {
        $data = [
            'title'             => 'Create a Post',
            'user_id'           => $_SESSION['user_id'],
            'post_title'        => '',
            'post_body'         => '',
            'post_title_err'    => '',
            'post_body_err'     => '',
        ];

        if ( $_SERVER[ 'REQUEST_METHOD'] == 'POST' ) {

            $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

            foreach ( $data as $key => $value ) {
                if ( strpos( $key, '_err' ) === false && $key != 'title' && $key != 'user_id') {

                    if ( empty( $_POST[ $key ] ) ) {
                        $data[$key . '_err'] = $key . ' couldn\'t be empty';
                    } else {
                        $data[$key] = $_POST[$key];
                    }
                }
            }

            if ( empty( $data[ 'post_title_err' ] ) && empty( $data[ 'post_body_err' ] ) ) {
                // insert post

                if ( $this->postModel->addPost( $data ) ) {
                    msg( 'post_added', 'Post Currently added');
                    redirect('posts/index' );
                } else {
                    return $this->view( '/posts/add', $data);
                }
            } else {
                return $this->view( '/posts/add', $data);
            }
        }

        return $this->view( '/posts/add', $data );
    }

    public function index() {

        $data = [
            'posts' => $this->postModel->getPosts()
        ];

        return $this->view( '/posts/index', $data);
    }

}