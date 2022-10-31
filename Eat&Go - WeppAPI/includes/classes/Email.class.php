<?php

/**
 *Email class
 * @author Dennis Kjellin, dekj2100@student.miun.se
 */

 class Email {
    private $name;
    private $subject;
    private $msg;
    private $email;
    //Set Title
    public function setName(string $name): bool
    { //Trim title, so no whitespace can be added in the beginning.
        $name = trim($name);
        if ($name != "") {
            $this->name = $name;
            return true;
        } else {
            return false;
        }
    }

      //Set email
      public function setEmail(string $email): bool
      { //Trim title, so no whitespace can be added in the beginning.
          $email = trim($email);
          if ($email != "") {
              $this->email = $email;
              return true;
          } else {
              return false;
          }
      }

          //Set subject
    public function setSubject(string $subject): bool
    { //Trim sub, so no whitespace can be added in the beginning.
        $subject = trim($subject);
        if ($subject != "") {
            $this->subject = $subject;
            return true;
        } else {
            return false;
        }
    }

        //Set email
        public function setMsg(string $msg): bool
        { //Trim title, so no whitespace can be added in the beginning.
            $msg = trim($msg);
            if ($msg != "") {
                $this->msg = $msg;
                return true;
            } else {
                return false;
            }
        }

      //send email
    public function postEmail(string $name, string $email, string $subject, string $msg): bool
    {

        // Check with set methods
        if (!$this->setName($name)) return false;
        if (!$this->setEmail($email)) return false;
        if (!$this->setSubject($subject)) return false;
        if (!$this->setMsg($msg)) return false;

        $mailTo = "dekj2100@student.miun.se";
        $headers = "From: " . $this->email;
        $text = "Du har fått ett meddelande från " . $this->name . ".\n\n" . $this->msg;

        return mail($mailTo, $this->subject, $text, $headers);
    }
 }

 ?>