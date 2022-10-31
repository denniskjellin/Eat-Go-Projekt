<?php

/**
 *Reservation class
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */

 class Reservation
 {
     private $db;
     private $date;
     private $time;
     private $phonenum;
     private $name;
     private $persons;

     // constructor with db-connection
     function __construct()
     {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        if ($this->db->connect_errno > 0) {
            die("Error connecting: " . $this->db->connect_error);
        }
     }

     // Add reservation
     public function addRes(string $date, string $time, string $phonenum, string $name, int $persons) : bool {

        //safety for storage
        $date = $this->db->real_escape_string($date);
        $time = $this->db->real_escape_string($time);
        $phonenum = $this->db->real_escape_string($phonenum);
        $name = $this->db->real_escape_string($name);
        $persons = $this->db->real_escape_string($persons);

        $name = strip_tags($name);
        $phonenum = strip_tags($phonenum);

        // Check with set methods
        if (!$this->setDate($date)) return false;
        if (!$this->setTime($time)) return false;
        if (!$this->setPhonenum($phonenum)) return false;
        if (!$this->setName($name)) return false;
        if (!$this->setPersons($persons)) return false;
     

     $sql = "INSERT INTO reservations(date, time, phonenum, name, persons)VALUES('" . $this->date . "', '" . $this->time . "', '" . $this->phonenum . "', '"
. $this->name . "', '" . $this->persons . "');";

    // Send query
    return mysqli_query($this->db, $sql);
 }

 //Update reservations (in case some customer want to contact us and change the reservation)
 public function updateRes(int $id, string $date, string $time, string $phonenum, string $name, int $persons) : bool {

       //safety for storage
       $date = $this->db->real_escape_string($date);
       $time = $this->db->real_escape_string($time);
       $phonenum = $this->db->real_escape_string($phonenum);
       $name = $this->db->real_escape_string($name);
       $persons = $this->db->real_escape_string($persons);

       $name = strip_tags($name);
       $phonenum = strip_tags($phonenum);

       // Check with set methods
       if (!$this->setDate($date)) return false;
       if (!$this->setTime($time)) return false;
       if (!$this->setPhonenum($phonenum)) return false;
       if (!$this->setName($name)) return false;
       if (!$this->setPersons($persons)) return false;

       //sql query for update reservation
       $sql = "UPDATE reservations SET date='" . $this->date . "', time='" . $this->time . "', phonenum='" . $this->phonenum . "', name='" . $this->name . "', persons='" . $this->persons . "' WHERE id=$id;";

        // send query
        return mysqli_query($this->db, $sql);
 }

 //Get reservations by ID
 public function getResById(int $id): array
 {
     $id = intval($id);
     $sql = "SELECT * FROM reservations WHERE id=$id;";
     $result = mysqli_query($this->db, $sql);
     return $result->fetch_assoc();
 }

   //Get reservation entrys
   function getRes(): array
   {
       $sql = "SELECT * FROM reservations ORDER BY created DESC;";
       $result = $this->db->query($sql);

       return mysqli_fetch_all($result, MYSQLI_ASSOC);
   }



    // Set methods
    //Set Title
    public function setDate(string $date): bool
    { //Trim title, so no whitespace can be added in the beginning.
        
        if ($date != "") {
            $this->date = $date;
            return true;
        } else {
            return false;
        }
    }

    //Set Time
    public function setTime(string $time): bool
    { 
        if ($time != "") {
            $this->time = $time;
            return true;
        } else {
            return false;
        }
    }

    //Set Phonenum
    public function setPhonenum(string $phonenum): bool
    { //Trim, so no whitespace can be added in the beginning.
        $phonenum = trim($phonenum);
        if ($phonenum != "") {
            $this->phonenum = $phonenum;
            return true;
        } else {
            return false;
        }
}

  //Set name
  public function setName(string $name): bool
  { //Trim, so no whitespace can be added in the beginning.
    $name = trim($name);
      if ($name != "") {
          $this->name = $name;
          return true;
      } else {
          return false;
      }
  }

    //Set Time
    public function setPersons (int $persons): bool
    { 
        
        if ($persons > 0) {
            $this->persons = $persons;
            return true;
        } else {
            return false;
        }
    }

    //Delete reservation entry
    public function deleteRes(int $deleteid): bool
    {
        $deleteid = intval($deleteid);
        //SQL query
        $sql = "DELETE FROM reservations WHERE id=$deleteid;";
        //Send query
        return mysqli_query($this->db, $sql);
    }

   //destructor
   function __destruct()
   {
       mysqli_close($this->db);
   }

}