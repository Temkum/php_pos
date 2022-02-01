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
            /* if (preg_match('/^\w{5,20}$/', $_POST['login_username']) && preg_match('/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{5,20}$/', $_POST['login_pwd'])) {
                $encrypt_pwd = password_hash($_POST["login_pwd"], PASSWORD_DEFAULT);
                print_r($encrypt_pwd);
                exit;

                $table = 'users';
                $item = 'role';
                $value = $_POST['login_username'];

                $response = UserModel::showUsers($table, $item, $value);

                if ($response["username"] == $_POST["login_username"] && $response["password"] == $encrypt_pwd) {
                    $_SESSION["loggedIn"] = "OK";

                    header('location: dashboard');
                } else {
                    echo '<br><div class="alert alert-danger">Username or password is incorrect</div>';
                }
            } */

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

            // validate credentials
            if (empty($username_err) && empty($password_err)) {
                // Prepare a select statement
                $sql = "SELECT id, username, password, name, role, photo FROM users WHERE username = :username";
        
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

                                if (password_verify($password, $hashed_password)) {
                                    session_start();

                                    // Store data in session variables
                                    $_SESSION["loggedIn"] = 'OK';
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;
                                    $_SESSION["role"] = $role;
                                    $_SESSION["photo"] = $profile_pic;
                                    $_SESSION["name"] = $name;
                            
                                    // Redirect user
                                    header("Location: dashboard");
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["name"]) ||
                preg_match('/^\w{5,20}$/', $_POST["username"]) ||
                preg_match("/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{5,20}$/", $_POST["password"])) {
                    
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
                             swal({
                                 type: "success",
                                 title: "User created successfully!",
                                 showConfirmButton: true,
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
					swal({
						type: "error",
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
}