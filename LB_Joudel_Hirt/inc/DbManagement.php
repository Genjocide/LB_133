<?php
class DbManagement
{
    private $host = 'mysql:host=localhost;dbname=happyplace';
    private $user = 'root';
    private $pw = '';
    private $tbl_users = 'users';
    private $tbl_student = 'student';
    private $tbl_place = 'place';

    private function connect(){
        try{
            $this->db = new PDO($this->host,$this->user,$this->pw);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOException $e){
            if(ini_get('display_errors')){
                echo $e->getMessage();
            }
            exit;
        }
    }

    public function user_authent($name, $password){

        $this->connect();
        $name = htmlspecialchars($name);;
        $password = htmlspecialchars($password);

        $prepare_state = $this->db->prepare("select id, name, password, user_type from happyplace.users
                                                    where name = :name or email = :email");

        $prepare_state->bindParam('name', $name);
        $prepare_state->bindParam('email', $name);
        $prepare_state->execute();
        $result = $prepare_state->rowCount();
        if ($result > 0)
        {
            $user = $prepare_state->fetch();
            if(password_verify($password,$user['password'])){
                if ($user['user_type'])
                {
                    $_SESSION['user_type'] = true;
                }
                else
                {
                    $_SESSION['user_type'] = false;
                }
                $_SESSION['activ_user'] = true;
                $_SESSION['activ_user_id'] = $user['id'];
            }
            else{
                $_SESSION['name'] = $user['name'];
                $_SESSION['error'] = 'Falsches Passwort für: ' . $user['name'];
            }
        }
        else{
            $_SESSION['error'] = 'Falscher Benutzername';
        }
        $prepare_state = null;
    }

    public function select_user($id){
        $this->connect();
        return $this->db->query("select * from $this->tbl_users where id = $id")->fetch();
    }

    public function select_all_users(){
        $this->connect();
        return $this->db->query("select * from $this->tbl_users")->fetchAll();
    }

    public function insert_into_user($name, $firstname, $email, $password){
        $this->connect();
        $name = htmlspecialchars($name);;
        $firstname = htmlspecialchars($firstname);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        if(isset($_POST['admin-rights']))
        {
            $this->user_type = true;
        }
        else
        {
            $this->user_type = false;
        }
        $prepare_state = $this->db->prepare("insert into $this->tbl_users (name,
                                                                                firstname, 
                                                                                email, 
                                                                                password,
                                                                                user_type) 
                                                                                values
                                                                                (:name,
                                                                                 :firstname,
                                                                                 :email,
                                                                                 :password,
                                                                                 :user_type)");

        $prepare_state->bindParam('name', $name);
        $prepare_state->bindParam('firstname', $firstname);
        $prepare_state->bindParam('email', $email);
        $prepare_state->bindParam('password', $password);
        $prepare_state->bindParam('user_type', $this->user_type);
        $prepare_state->execute();
    }

    public function update_password($password){
        $this->connect();
        $password = password_hash(htmlspecialchars($password), PASSWORD_DEFAULT);
        $user_id = $_SESSION['activ_user_id'];
        $prepare_state = $this->db->prepare("update $this->tbl_user set password = :password where id = $user_id");
        $prepare_state->bindParam("password", $password);
        $prepare_state->execute();
    }

    public function update_user($id, $name, $firstname, $email, $pw_change, $password, $user_type){
        $id = htmlspecialchars($id);
        $name = htmlspecialchars($name);
        $firstname = htmlspecialchars($firstname);
        $email = htmlspecialchars($email);

        $this->connect();
        if($pw_change){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $prepare_state = $this->db->prepare("update $this->tbl_users 
                                            set name = :name,
                                            firstname = :firstname,
                                            email = :email,
                                            password = :password,
                                            user_type = :user_type
                                            where id = :id");

            $prepare_state->bindParam('name', $name);
            $prepare_state->bindParam('firstname', $firstname);
            $prepare_state->bindParam('email', $email);
            $prepare_state->bindParam('password', $password);
            $prepare_state->bindParam('user_type', $user_type);
            $prepare_state->bindParam('id', $id);
        }
        else{
            $prepare_state = $this->db->prepare("update $this->tbl_users 
                                            set name = :name,
                                            firstname = :firstname,
                                            email = :email,
                                            user_type = :user_type
                                            where id = :id");

            $prepare_state->bindParam('name', $name);
            $prepare_state->bindParam('firstname', $firstname);
            $prepare_state->bindParam('email', $email);
            $prepare_state->bindParam('user_type', $user_type);
            $prepare_state->bindParam('id', $id);
        }
        $prepare_state->execute();

    }

    public function delete_user($id){
        $this->connect();
        $this->db->query("delete from $this->tbl_users where id = $id");
    }

    public function update_student($id, $name, $firstname, $zip){
        $id = htmlspecialchars($id);
        $name = htmlspecialchars($name);
        $firstname = htmlspecialchars($firstname);
        $zip = htmlspecialchars($zip);

        $this->connect();
        $prepare_state = $this->db->prepare("update $this->tbl_student 
                                            set name = :name,
                                            firstname = :firstname,
                                            zip = :zip
                                            where id = :id");

        $prepare_state->bindParam('name', $name);
        $prepare_state->bindParam('firstname', $firstname);
        $prepare_state->bindParam('zip', $zip);
        $prepare_state->bindParam('id', $id);
        $prepare_state->execute();
        
    }

    public function select_student($id){
        $this->connect();
        return $this->db->query("select
        id AS \"ID\",
        firstname as \"Vorname\",
        name as \"Nachname\",
        zip as \"PLZ\"
        from $this->tbl_student where id = $id")->fetch();
    }

    public function select_all_students(){
        $this->connect();
        return $this->db->query("select
        s.id AS \"ID\",
        s.firstname as \"Vorname\",
        s.name as \"Nachname\",
        p.latitude as \"LAT\",
        p.longitude as \"LONG\",
        p.name as \"Ort\"
        from $this->tbl_student s inner join happyplace.place p on s.zip = p.id")->fetchAll();
    }

    public function insert_into_student($name, $firstname, $zip)
    {
        $this->connect();
        $name = htmlspecialchars($name);;
        $firstname = htmlspecialchars($firstname);
        $zip = htmlspecialchars($zip);
        $prepare_state = $this->db->prepare("insert into $this->tbl_student (
                                                                                    name,
                                                                                    firstname,
                                                                                    zip
                                                                                    )
                                                                                    values
                                                                                    (
                                                                                     :name,
                                                                                     :firstname,
                                                                                     :zip)");

        $prepare_state->bindParam('name', $name);
        $prepare_state->bindParam('firstname', $firstname);
        $prepare_state->bindParam('zip', $zip);
        $prepare_state->execute();
    }

    public function delete_student($id){
        $this->connect();
        $this->db->query("delete from $this->tbl_student where id = $id");
    }

    public function select_places(){
        $this->connect();
        return $this->db->query("select id, name from $this->tbl_place order by name")->fetchAll();
    }
}