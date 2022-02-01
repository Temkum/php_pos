<?php
/**
 *
 */
class UsersController
{
    public static function login()
    {
        if (isset($_POST['username'])) {
            if (preg_match('/^[a-zA=Z0-9]+$/', $_POST['username']) && preg_match('/^[a-zA=Z0-9]+$/', $_POST['password'])) {
                $table = 'users';
                $item = 'role';
                $value = $_POST['username'];

                $response = UserModel::showUsers($table, $item, $value);

                if ($response["username"] == $_POST["username"] && $response["password"] == $_POST["password"]) {
                    $_SESSION["loggedIn"] = "OK";

                    header('location: dashboard');
                } else {
                    echo '<br><div class="alert alert-danger">User or password incorrect</div>';
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

                $data = array('name' => $_POST["name"],
                     'username' => $_POST["username"],
                     'password' => $_POST['password'],
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
}