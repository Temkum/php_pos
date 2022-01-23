<?php
/**
 *
 */
class UsersController {

	public function login() {

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
}