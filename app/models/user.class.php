<?php

class user
{
    private $error = "";
    public function signup($POST)
    {
        $data = array();
        $db = Database::getInstance();

        $data['name']       = trim($POST['name']);
        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);
        $password2          = trim($POST['password2']);

        if (empty($data['email']) || !preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email'])) {
            $this->error .= "Entrez un email valide </br>";
        }

        if (empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name'])) {
            $this->error .= "Le nom n'est pas valide </br>";
        }

        if ($data['password'] !== $password2) {
            $this->error .= "Les mots de passe ne correspondent pas </br>";
        }

        if (strlen($data['password']) < 4) {
            $this->error .= "Le mot de passe doit avoir au moins 4 caractères </br>";
        }

        //check if email already exists 
        $sql = "select * from users where email = :email limit 1";
        $arr['email'] = $data['email'];
        $check = $db->read($sql, $arr);
        if (is_array($check)) {
            $this->error .= "Un compte existe déjà avec cet email </br>";
        }

        $data['url_adress'] = $this->get_random_string_max(60);
        //check url_adress
        $arr = false;
        $sql = "select * from users where url_adress = :url_adress limit 1";
        $arr['url_adress'] = $data['url_adress'];
        $check = $db->read($sql, $arr);
        if (is_array($check)) {
            $data['url_adress'] = $this->get_random_string_max(60);
        }


        if ($this->error == "") {
            //save
            $data['rank'] = "customer";
            $data['date'] = date("Y-m-d H:i:s");
            $data['password'] = hash('sha1', $data['password']);

            $query = "insert into users (url_adress,name,email,password,rank,date) values (:url_adress,:name,:email,:password,:rank,:date)";
            $result = $db->write($query, $data);

            if ($result) {

                header("Location: " . ROOT . "login");
                die;
            }
        }

        $_SESSION['error'] = $this->error;
    }

    public function login($POST)
    {
        $data = array();
        $db = Database::getInstance();

        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);

        if (empty($data['email']) || !preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['email'])) {
            $this->error .= "Entrez un email valide </br>";
        }

        if (strlen($data['password']) < 4) {
            $this->error .= "Le mot de passe doit avoir au moins 4 caractères </br>";
        }

        if ($this->error == "") {
            //confirm
            $data['password'] = hash('sha1', $data['password']);


            //check if email already exists 
            $sql = "select * from users where email = :email && password = :password limit 1";
            $result = $db->read($sql, $data);
            if (is_array($result)) {
                $_SESSION['user_url'] = $result[0]->url_adress;
                header("Location: " . ROOT . "home");
                die;
            }

            $this->error .= "Email ou mot de passe incorrect </br>";
        }

        $_SESSION['error'] = $this->error;
    }

    public function get_user($url)
    {
    }

    private function get_random_string_max($length)
    {

        $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $text = "";

        $length = rand(4, $length);

        for ($i = 0; $i < $length; $i++) {

            $random = rand(0, 61);

            $text .= $array[$random];
        }

        return $text;
    }

    function check_login($redirect = false, $allowed = array())
    {
        $db = Database::getInstance();

        if (count($allowed) > 0) {
            $arr['url'] = $_SESSION['user_url'];
            $query = "select * from users where url_adress = :url limit 1";
            $result = $db->read($query, $arr);

            if (is_array($result)) {
                $result = $result[0];

                if (in_array($result->rank, $allowed)) {
                    return $result;
                }
            }
            header("Location: " . ROOT . "login");
            die;
        } else {

            if (isset($_SESSION['user_url'])) {
                $arr = false;
                $arr['url'] = $_SESSION['user_url'];
                $query = "select * from users where url_adress = :url limit 1";

                $result = $db->read($query, $arr);
                if (is_array($result)) {
                    return $result[0];
                }
            }

            if ($redirect) {
                header("Location: " . ROOT . "login");
                die;
            }
        }
        return false;
    }

    public function logout()
    {
        if (isset($_SESSION['user_url'])) {
            unset($_SESSION['user_url']);
        }

        header("Location: " . ROOT . "home");
        die;
    }
}
