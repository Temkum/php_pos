<?php
/**
 *
 */
class UsersController
{
    public static function login()
    {
        // Define variables and initialize with empty values
        $username = $password = "";
        $username_err = $password_err = $login_err = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

             // Check if username is empty
            if (empty(trim($_POST["login_username"]))) {
                $username_err = '<br><div class="alert alert-danger">Please enter username!</div>';
                echo $username_err;
            } else {
                $username = trim($_POST["login_username"]);
            }
            // Check if password is empty
            if (empty(trim($_POST["login_pwd"]))) {
                $password_err = '<br><div class="alert alert-danger">Please enter your password!</div>';
                echo $password_err;
            } else {
                $password = trim($_POST["login_pwd"]);
            }

            $table = 'users';

            // validate credentials
            if (empty($username_err) && empty($password_err)) {
                // Prepare a select statement
                $sql = "SELECT * FROM users WHERE username = :username";

                if ($stmt = Connection::connect()->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

                    // Set parameters
                    $param_username = trim($_POST["login_username"]);

                    // Attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        // Check if username exists, if yes then verify password
                        if ($stmt->rowCount() == 1) {
                            if ($row = $stmt->fetch()) {
                                $id = $row["id"];
                                $username = $row["username"];
                                $hashed_password = $row["password"];
                                $role = $row["role"];
                                $profile_pic = $row["photo"];
                                $name = $row["name"];
                                $status = $row['status'];
                                
                                if (password_verify($password, $hashed_password)) {
                                    if ($status == 1) {
                                        // Store data in session variables
                                        $_SESSION["loggedIn"] = 'OK';
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $username;
                                        $_SESSION["role"] = $role;
                                        $_SESSION["photo"] = $profile_pic;
                                        $_SESSION["name"] = $name;
                                        $_SESSION["status"] = $status;

                                        // capture date & time for last login
                                        date_default_timezone_set('Africa/Douala');
                                        $date_time = date('Y-m-d H:i:s');
                                     
                                        $item1 = "last_login";
                                        $value1 = $date_time;
                                        
                                        $item2 = "id";
                                        $value2 = $id;

                                        $last_login = UserModel::activateUser($table, $item1, $value1, $item2, $value2);

                                        if ($last_login == 'OK') {
                                            // Redirect user
                                            header("Location: dashboard");
                                        }
                                    } else {
                                        $status_err = '<br><div class="alert alert-danger">User is not activated!</div>';
                                        echo  $status_err;
                                    }
                                } else {
                                    // Password is not valid, display a generic error message
                                    $login_err = '<br><div class="alert alert-danger">Invalid username or password.</div>';
                                    echo  $login_err;
                                }
                            }
                        } else {
                            // Username doesn't exist, display a generic error message
                            $login_err = '<br><div class="alert alert-danger">Invalid username or password.</div>';
                            echo $login_err;
                        }
                    } else {
                        echo '<br><div class="alert alert-danger">Oops! Something went wrong. Please try again later.</div>';
                    }

                    // Close statement
                    unset($stmt);
                }
            }
        }
    }

    /* register user */
    public function register()
    {
        if (isset($_POST["username"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', isset($_POST["name"])) ||
                preg_match('/^\w{5,20}$/', $_POST["username"]) ||
                preg_match("/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{5,20}$/", isset($_POST["password"]))) {
                    
                    /*validate user img*/
                $photo = "";

                if (isset($_FILES["profile_img"]["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["profile_img"]["tmp_name"]);

                    $new_height = 500;
                    $new_width = 500;

                    // create folder for each user
                    $folder = "views/img/users/".$_POST["username"];

                    if (!file_exists($folder)) {
                        mkdir($folder, 0777);
                    }

                    if ($_FILES["profile_img"]["type"] == "image/png") {
                        $randomNumber = mt_rand(100, 999);
                        $img_name = $_POST["username"] . $randomNumber;
                        
                        $photo = "views/img/users/".$_POST["username"]."/". $img_name .".png";
                        
                        $srcImage = imagecreatefrompng($_FILES["profile_img"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagepng($destination, $photo);
                    } elseif ($_FILES["profile_img"]["type"] == "image/jpeg") {
                        $randomNumber = mt_rand(100, 999);
                        $img_name = $_POST["username"] . $randomNumber;
                        
                        $photo = "views/img/users/".$_POST["username"]."/". $img_name .".jpg";
                        
                        $srcImage = imagecreatefromjpeg($_FILES["profile_img"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagejpeg($destination, $photo);
                    }
                }
                    
                $table = 'users';
                $encrypt_pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);

                $data = array('name' => $_POST["name"],
                     'username' => $_POST["username"],
                     'password' => $encrypt_pwd,
                     'role' => $_POST["role"],
                    'photo' => $photo);

                $result = UserModel::addUser($table, $data);

                if ($result == 'OK') {
                    echo '<script>
                             Swal.fire({
                                 icon: "success",
                                 title: "User created successfully!",
                                 showConfirmButton: true,
                                 timer: 1500,
                                 confirmButtonText: "Close"
                                 }).then(function(result){
                                     if(result.value){
                                         window.location = "users";
                                     }
                                 });
                         </script>';
                }
            } else {
                echo '<script>
					Swal.fire({
						icon: "error",
						title: "No special characters or blank fields are allowed",
						showConfirmButton: true,
						confirmButtonText: "Close"
						}).then(function(result){
							if(result.value){
								window.location = "users";
							}
						});
					</script>';
            }
        }
    }

    // display users
    public static function getUsers($item, $value)
    {
        $table = "users";

        $response = UserModel::showUsers($table, $item, $value);

        return $response;
    }

    // edit users
    public function editUser()
    {
        if (isset($_POST["editusername"])) {
            if (preg_match('/^[a-zA-Z0-9_]+$/', $_POST["editusername"])) {
                                                   
                /*validate user img*/
                $photo = $_POST['currentpic'];

                if (isset($_FILES["editimage"]["tmp_name"]) && !empty($_FILES['editimage']["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["editimage"]["tmp_name"]);

                    $new_height = 500;
                    $new_width = 500;

                    // create folder for each user
                    $folder = "views/img/users/".$_POST["editusername"];

                    if (!empty($_POST['currentpic'])) {
                        unlink($_POST['currentpic']);
                    } else {
                        mkdir($folder, 0777);
                    }

                    if ($_FILES["editimage"]["type"] == "image/png") {
                        $randomNumber = mt_rand(100, 999);
                        $img_name = $_POST["editusername"] . $randomNumber;
                        
                        $photo = "views/img/users/".$_POST["editusername"]."/". $img_name .".png";
                        
                        $srcImage = imagecreatefrompng($_FILES["editimage"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagepng($destination, $photo);
                    } elseif ($_FILES["editimage"]["type"] == "image/jpeg") {
                        $randomNumber = mt_rand(100, 999);
                        $img_name = $_POST["editusername"] . $randomNumber;
                        
                        $photo = "views/img/users/".$_POST["editusername"]."/". $img_name .".jpg";
                        
                        $srcImage = imagecreatefromjpeg($_FILES["editimage"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagejpeg($destination, $photo);
                    }
                }
                    
                $table = 'users';
                $encrypt_pwd = password_hash($_POST["editpwd"], PASSWORD_DEFAULT);
                
                $data = array('name' => $_POST["editname"],
                     'username' => $_POST["editusername"],
                     'password' => $encrypt_pwd,
                     'role' => $_POST["editrole"],
                    'photo' => $photo);

                $result = UserModel::modifyUser($table, $data);
                
                if ($result == 'OK') {
                    echo '<script>
                             Swal.fire({
                                 icon: "success",
                                 title: "User updated successfully!",
                                 showConfirmButton: true,
                                 timer: 2000
                                 }).then(function(result){
                                     if(result.value){
                                         window.location = "users";
                                     }
                                 });
                         </script>';
                }
            } else {
                echo '<script>
					Swal.fire({
						icon: "error",
                        position: "top-end",
						title: "User update failed. Please try again later!",
                        timer: 5000						
						}).then((result)=>{
							if(result.value){
								window.location = "users";
							}
						});
					</script>';
            }
        }
    }
}