<?php
/**
 * Class registration
 * handles the user registration
 */
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }
    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Neįvestas slaptažodis";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Tuščias slaptažodis";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Nesutampa slaptažodžiai";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Mažiausiai 6 simboliai";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Vartotojo vardas negali būti trumpesnis nei 2 ar ilgesnis nei 64 simboliai";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Tik raidės a-Z ir skaičiai, nuo 2 iki 64 simbolių";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "El. pašto laukas negali būti tuščias";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "El. pašto adresas negali būti ilgesnis nei 64 simboliai";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Blogas el. pašto formatas";
        } elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }
            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {
                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
                $user_password = $_POST['user_password_new'];
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);
                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Atsiprašome, toks vartotojas jau registruotas sistemoje.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO users (user_name, user_password_hash, user_email)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);
                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Jūsų paskyra buvo sėkmingai sukurta. Galite prisijungti.";
                    } else {
                        $this->errors[] = "SRegistracija nesėkminga. Bandykite dar kartą.";
                    }
                }
            } else {
                $this->errors[] = "Klaida jungiantis su duomenų baze.";
            }
        } else {
            $this->errors[] = "Nežinoma klaida.";
        }
    }
}