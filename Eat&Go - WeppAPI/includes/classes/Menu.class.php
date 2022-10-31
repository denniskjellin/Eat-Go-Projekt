<?php

/**
 *WeekMenu class
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */

class Menu
{
    //Properties
    private $db;
    private $title;
    private $week;
    private $content;
    private $year;
    private $id;


    // constructor with db-connection
    function __construct()
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        if ($this->db->connect_errno > 0) {
            die("Error connecting: " . $this->db->connect_error);
        }
    }

    // Add menu entry
    public function addMenu(int $week, string $title, string $content, int $year): bool
    {
        //Sanitera input real_escape_string
        $title = $this->db->real_escape_string($title);
        $content = $this->db->real_escape_string($content);
        $week = $this->db->real_escape_string($week);
        $year = $this->db->real_escape_string($year);

        $content = strip_tags($content, [
            'h1', 'h2', 'h3', 'pre', 'em', 'blockquote', 'a', 'p',
            'strong', 'ul', 'ol', 'li', 'tabel', 'tbody', 'tr', 'td'
        ]);

        $title = strip_tags($title, [
            'h1', 'h2', 'h3', 'em', 'pre', 'blockquote', 'p', 'a',
            'ul', 'ol', 'li', 'strong', 'tabel', 'tbody', 'tr', 'td'
        ]);

        // Check with set methods
        if (!$this->setTitle($title)) return false;
        if (!$this->setContent($content)) return false;
        if (!$this->setWeek($week)) return false;
        if (!$this->setYear($year)) return false;

        // SQL query
        $sql = "INSERT INTO weekmenu(week, title, content, year)VALUES('" . $this->week . "', '" . $this->title . "', '" . $this->content . "', '" . $this->year . "');";

        // Send query
        return mysqli_query($this->db, $sql);
    }

    //Update post
    public function updateMenu(int $id, string $title, string $content, int $week, int $year): bool
    {

        //Sanitera input real_escape_string
        $title = $this->db->real_escape_string($title);
        $content = $this->db->real_escape_string($content);
        $week = $this->db->real_escape_string($week);
        $year = $this->db->real_escape_string($year);
        // Check with set methods

        if (!$this->setTitle($title)) return false;
        if (!$this->setContent($content)) return false;
        if (!$this->setWeek($week)) return false;
        if (!$this->setYear($year)) return false;

        $content = strip_tags($content, [
            'h1', 'h2', 'h3', 'pre', 'em', 'blockquote', 'a', 'p',
            'strong', 'ul', 'ol', 'li', 'tabel', 'tbody', 'tr', 'td'
        ]);

        $title = strip_tags($title, [
            'h1', 'h2', 'h3', 'em', 'pre', 'blockquote', 'p', 'a',
            'ul', 'ol', 'li', 'strong', 'tabel', 'tbody', 'tr', 'td'
        ]);

        //sql query
        $sql = "UPDATE weekmenu SET week='" . $this->week . "', title='" . $this->title . "', content='" . $this->content . "', year='" . $this->year . "' WHERE id=$id;";

        // send query
        return mysqli_query($this->db, $sql);
    }

    //Get specific menu post from ID
    public function getMenuById(int $id): array
    {
        $id = intval($id);
        $sql = "SELECT * FROM weekmenu WHERE id=$id;";
        $result = mysqli_query($this->db, $sql);
        return $result->fetch_assoc();
    }

       //Get specific menu post for currentweek
       public function getMenuByweek(string $week, string $year): array
       {
           
           $sql = "SELECT * FROM weekmenu WHERE week=$week AND year=$year;";
           $result = mysqli_query($this->db, $sql);
           return $result->fetch_assoc();
       }
       
    //Get menu entrys
    function getMenus(): array
    {
        $sql = "SELECT * FROM weekmenu ORDER BY created DESC;";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    //Delete menu entry
    public function deleteMenu(int $deleteid): bool
    {
        $deleteid = intval($deleteid);
        //SQL query
        $sql = "DELETE FROM weekmenu WHERE id=$deleteid;";
        //Send query
        return mysqli_query($this->db, $sql);
    }

    //Set-methods

    //Set Title
    public function setTitle(string $title): bool
    { //Trim title, so no whitespace can be added in the beginning.
        $title = trim($title);
        if ($title != "") {
            $this->title = $title;
            return true;
        } else {
            return false;
        }
    }



    // Set Content 
    public function setContent(string $content): bool
    { //Trim content, so no whitespace can be added in the beginning.
        $content = trim($content);
        if ($content != "") {
            $this->content = $content;
            return true;
        } else {
            return false;
        }
    }

    //Set Week
    public function setWeek(int $week): bool
    { 
      if($week > 0) {
          $this->week = $week;
          return true;
      } else {
          return false;
      }
    }

       //Set year
       public function setYear(int $year): bool
       { 
         if($year > 0) {
             $this->year = $year;
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
