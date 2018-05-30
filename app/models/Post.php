<?php

class Post extends Controller {

    private $db;

    public function __construct() {

        /**
         * Create connection to database
         */
        $this->db = new Database;

    }

    public function getPostById( $id ) {

        $this->db->query( 'SELECT * FROM posts WHERE id = :id' );

        $this->db->bind( ':id', $id );

        $row = $this->db->single();

        if ( $this->db->rowCount() ) {
            return $row;
        } else { return false; }
    }

    public function showPost( $id ) {

        $this->db->query( 'SELECT * FROM posts WHERE id = :id');
        $this->db->bind( ':id', $id );
        $row = $this->db->single();
        if ( $this->db->rowCount() ) {
            return $row;
        } else { return false; }
    }

    public function deletePost( $id ) {

        $this->db->query( 'DELETE FROM posts WHERE id = :id');

        $this->db->bind( ':id', $id );

        $this->db->execute();

        if ( $this->db->rowCount() > 0 ) {
            return true;
        } else { return false; }

    }

    public function editPost( $data ) {

        $this->db->query( 'UPDATE posts SET title=:title, body = :body WHERE id = :id');

        $this->db->bind( ':title', $data['post_title'] );
        $this->db->bind( ':body', $data['post_body'] );
        $this->db->bind( ':id', $data['id'] );

        $this->db->execute();

        if ( $this->db->rowCount() > 0 ) {
            return true;
        } else { return false; }

    }

    public function addPost( $data ) {

        $this->db->query( 'INSERT INTO posts ( title, body, user_id ) VALUES ( :title, :body, :user_id );');

        $this->db->bind( ':title', $data['post_title'] );
        $this->db->bind( ':body', $data['post_body'] );
        $this->db->bind( ':user_id', $data['user_id'] );

        $this->db->execute();

        if ( $this->db->rowCount() > 0 ) {
            return true;
        } else { return false; }

    }

    public function getPosts() {

        /**
         * Prepare query
         */
        $this->db->query( 'SELECT *,
                                    posts.id AS postId,
                                    users.id AS userId,
                                    posts.created_at AS postCreated,
                                    users.created_at AS userCreated
                                    FROM users INNER JOIN posts
                                    ON posts.user_id = users.id
                                    ORDER BY posts.created_at DESC');

        /**
         * Get results
         */
        $results = $this->db->resultSet();

        /**
         * Return result
         */
        return $results;
    }
}