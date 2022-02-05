<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Categories</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Categories</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCategory">
          <i class="fa fa-plus"></i>
          Add Category
        </button>

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
                    <th class="">Category Name</th>
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
                          <td class="dtr-control sorting_1" tabindex="0">'.($key + 1).'</td>
                          <td>'.$user['name'].'</td>
                          <td>'.$user['username'].'</td>';
                        if ($user["photo"] != "") {
                            echo '<td><img src="'.$user["photo"].'" alt="User image" width="50"></td>';
                        } else {
                            echo '<td><img src="views/img/avatar.jpg" alt="User image" width="50"></td>';
                        }

                        echo   '<td>'.$user["role"].'</td>';
                        if ($user['status'] == 1) {
                            echo '<td class="badge-success btn badge btn-activate" userId="'.$user["id"].'" 
                            userStat="0">Active</td>';
                        } else {
                            echo '<td class="badge-danger btn badge btn-activate" userId="'.$user["id"].'"
                            userStat="1">Deactivated</td>';
                        }
                        echo '<td>'. $user["last_login"] .'</td>';
                        echo '<td class="action">
                      <button class="btn btn-warning btn-sm editUserBtn" data-toggle="modal" data-target="#editUser" userId="'.$user["id"].'">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-sm delUserBtn" userId="'.$user["id"].'" userPhoto="'.$user["photo"].'" userName="'.$user["username"].'">
                      <i class="fa fa-trash"></i></button>
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
</div>

<!-- Add category Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header mb-3">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" enctype="multipart/form-data">
          <div class="form-row align-items-center">
            <div class="col-auto">
              <label class="sr-only" for="inlineFormInputGroup">Category Name</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-layer-group"></i></div>
                </div>
                <input type="text" class="form-control" name="new_category" placeholder="Enter Category name">
              </div>
            </div>

            <div class="col-12 mt-3">
              <button type="submit" class="btn btn-primary mb-2">Save Category</button>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

          <?php
        //   $user = new UsersController();
        //   $user->store();
            ?>
        </form>
      </div>

    </div>
  </div>
</div>