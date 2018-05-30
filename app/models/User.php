<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 02/03/2018
 * Time: 12:24 PM
 */

class User
{

    private $db;

    public function __construct() {

        // Create connection to database for use as model
        $this->db = new Database;

    }

    public function getUserById( $id ) {
        $this->db->query( 'SELECT * FROM users WHERE id = :id' );
        $this->db->bind( ':id', $id );
        $row = $this->db->single();
        if ( $this->db->rowCount() > 0 ) {
            return $row;
        } else { return false; }
    }

    public function login ( $email, $password ) {

        /**
         * If user exists
         */
        $this->db->query( 'SELECT * FROM users WHERE email = :email' );

        /**
         * Binding values
         */
        $this->db->bind( ':email', $email );

        $row = $this->db->single();

        if ( password_verify( $password, $row->password) ) {
            return $row;
        } else { return false; }


    }

    public function register($data) {

        // Prepare information for insert to database
        $this->db->query( 'INSERT INTO users (username, password, email) VALUES ( :username, :password, :email );' );

        // Binding values
        $this->db->bind(':username', $data['name']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':email', $data['email'] );

        // Execute the query
        if ( $this->db->execute() ) {
            return true;
        } else { return false; }

    }

    public function findUserByEmail($email) {

        /**
         * Add SELECT Query
         */
        $this->db->query( 'SELECT * FROM users WHERE email = :email' );

        /**
         * Bind Email variable to prepared query
         */
        $this->db->bind( ':email', $email );

        /**
         * Get the result
         */
        $sql = $this->db->single();

        /**
         * return true if there is result else return false
         */
        if ( $this->db->rowCount() > 0 ) {
            return true;
        } else { return false; }
    }

}