<div class="content-wrapper">
  <style>
  .modal-title {
    text-transform: uppercase;
  }

  .sorting {
    width: 10px;
  }
  </style>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i>
          Add User</button>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>

      <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

          <div class="row">
            <div class="col-sm-12 table-responsive">
              <table id="example1" class="table table-bordered table-striped dataTable dtr-inline tables" role="grid"
                aria-describedby="example1_info">
                <thead>
                  <tr role="row">
                    <th class="sorting">#</th>
                    <th class="">Name</th>
                    <th class="">Username
                    </th>
                    <th class="">
                      Image</th>
                    <th class="">
                      Role</th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                      aria-label="CSS grade: activate to sort column ascending">Status
                    </th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                      aria-label="CSS grade: activate to sort column ascending">Last
                      Seen</th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                      aria-label="CSS grade: activate to sort column ascending">Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $item = null;
                    $value = null;
                    $users = UsersController::getUsers($item, $value);
                   
                    foreach ($users as $key => $user) {
                        echo '<tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">1</td>
                    <td>'.$user['name'].'</td>
                    <td>'.$user['username'].'</td>';
                        if ($user["photo"] != "") {
                            echo '<td><img src="'.$user["photo"].'" alt="User image" width="50"></td>';
                        } else {
                            echo '<td><img src="views/img/avatar.jpg" alt="User image" width="50"></td>';
                        }

                        echo   '<td>'.$user["role"].'</td>
                    <td class="badge badge-success">Active</td>
                    <td>'.$user["created_at"].'</td>
                    <td class="action">
                      <button class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Add user Modal -->
  <div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="modal-header mb-3">
            <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form method="POST" enctype="multipart/form-data">
            <div class="form-row align-items-center">
              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Name</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control" name="name" placeholder="Enter Name">
                </div>
              </div>

              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Username</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-key"></i></div>
                  </div>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                </div>
              </div>

              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Password</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
              </div>

              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Role</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user-tag"></i></div>
                  </div>
                  <select class="custom-select" name="role">
                    <option selected>Choose role</option>
                    <option value="admin">Administrator</option>
                    <option value="cashier">Cashier</option>
                    <option value="vendor">Vendor</option>
                  </select>
                </div>
              </div>

              <div class="col-auto">
                <label class="sr-only">Image</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-image"></i></div>
                  </div>
                  <input type="file" class="new_img" name="profile_img" placeholder="Select profile image">
                </div>
                <p>Max image size is 5MB</p>
                <img src="views/img/avatar.jpg" alt="" width="50" class="img-thumbnail preview">
              </div>

              <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?php
            $user = new UsersController();
            $user->register();
              ?>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>