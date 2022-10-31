<?php

/**
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */

class Users
{
    private $db;
    private $username;
    private $password;

    // constructor with db-connection
    function __construct()
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        if ($this->db->connect_errno > 0) {
            die("Error connecting: " . $this->db->connect_error);
        }
    }

    /**
     * Register new user
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function registerUser(string $username, string $password): bool
    {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        $username = $this->db->real_escape_string($username);
        $password = $this->db->real_escape_string($password);

        // make sure HTML code cant be written out
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $password = strip_tags($password);
       
    
        // Check with seth methods
        if (!$this->setUsername($username)) return false;
        if (!$this->setPassword($password)) return false;


        $sql = "INSERT INTO user(username, password) VALUES('" . $this->username . "', '" . $hashed_password . "');";

        // Send query
        return mysqli_query($this->db, $sql);
    }

    /**
     * Check login
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function loginUser(string $username, string $password): bool
    {

        $sql = "SELECT * FROM user WHERE username='$username';";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if (password_verify($password, $stored_password)) {
                $_SESSION['username'] = $username;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    /**
     * Check if user is logged in
     * @param string $username
     * @return boolean
     */
    public function isLoggedIn(): bool
    {
        if (isset($_SESSION['username'])) {
            return true;
        } else {
            return false;
        }
    }

    //If not logged in, redirect to another page
    public function restricted()
    {
        if (!isset($_SESSION['username'])) {
            header("Location: login.php?error=You have to be logged in!");
            exit;
        }
    }


    //Delete user
    public function deleteUser(int $deleteid): bool
    {
        $deleteid = intval($deleteid);
        //SQL query
        $sql = "DELETE FROM user WHERE id=$deleteid;";
        //Send query
        return mysqli_query($this->db, $sql);
    }

    // Logout user
    public function logoutUser()
    {
        session_destroy();
        header("Location: login.php");
        exit;
    }


    //Set methods
    public function setUsername(string $username): bool
    {
        //Trim username, so no whitespace can be added in the beginning.
        $username = trim($username);
        if (strlen($username) > 3) {
            $this->username = $username;
            return true;
        } else {
            return false;
        }
    }

    public function setPassword(string $password): bool
    {
        //trim, no whitespace
        $password = trim($password);
        if (strlen($password) > 7) {
            $this->password = $password;
            return true;
        } else {
            return false;
        }
    }

    // Check if username is already taken
    public function userNameTaken(string $username): bool
    {

        $sql = "SELECT username FROM user WHERE username='$username'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //destructor
    function __destruct()
    {
        mysqli_close($this->db);
    }
}
