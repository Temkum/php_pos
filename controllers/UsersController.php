<?php
/**
 *
 */
class UsersController {

	public static function login() {

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
	public static function register() {
		if (isset($_POST["name"])) {

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["name"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["username"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])) {

				$table = 'users';

				$data = array('name' => $_POST["name"],
					'username' => $_POST["username"],
					'password' => $_POST['password'],
					'role' => $_POST["role"],
					'photo' => $_POST['photo']);

				$result = UserModel::addUser($table, $data);

				if ($result == 'OK') {
					echo '<script>
					swal({
						type: "success",
						title: "User created successfully!",
						showConfirmButton: true,
						confirmButtonText: "Close"

						}).then((result)=>{
							if(result.value){
								window.location = "users";
							}
						});
				</script>';
				} else {
					echo "Error adding user";
				}

			} else {
				echo '<script>
				swal({
					type: "error",
					title: "No special characters or blank fields",
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