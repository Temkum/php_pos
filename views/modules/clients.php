<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin Clients</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Clients</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCustomer">
          <i class="fa fa-plus"></i>
          Add Client
        </button>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>

      <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
          <div class="row">
            <div class="col-sm-12 table-responsive">
              <table id="example1" class="table table-bordered table-striped dataTable dtr-inline tables" role="grid"
                aria-describedby="example1_info">
                <thead>
                  <tr role="row">
                    <th class="sorting">#</th>
                    <th class="">Customer's Name</th>
                    <th class="">Document ID</th>
                    <th class="">Email</th>
                    <th class="">Telephone</th>
                    <th class="">Address</th>
                    <th class="">Total purchase</th>
                    <th class="">Last Login</th>
                    <th class="">Date added</th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                      aria-label="CSS grade: activate to sort column ascending">Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                        $item = null;
                        $value = null;
                        $clients = ClientsController::display($item, $value);

                        foreach ($clients as $key => $client) {
                            echo '<tr class="odd">
                          <td class="dtr-control sorting_1" tabindex="0">'.($key + 1).'</td>
                          <td>'.$client['name'].'</td>
                          <td>'.$client['document_id'].'</td>
                          <td>'.$client['email'].'</td>
                          <td>'.$client['phone'].'</td>
                          <td>'.$client['address'].'</td>
                          <td>'.$client['purchases'].'</td>
                          <td>'.$client['last_login'].'</td>
                          <td>'.$client['created_at'].'</td>
                          <td class="action">
                                <button class="btn btn-success btn-sm editClient-Btn" data-toggle="modal" data-target="#editClient" clientID="'.$client['id'].'">
                                    <i class="fa fa-pencil-alt text-white"></i>
                                </button>
                                
                                <button class="btn btn-danger btn-sm delClient-Btn" clientID="'.$client['id'].'">
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

<!-- Add client Modal -->
<div class="modal fade" id="addCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header mb-3">
          <h5 class="modal-title" id="exampleModalLabel">Add client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST">
          <div class="form-row align-items-center">
            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Client's Name</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control" name="new_name" placeholder="Enter Client's name">
              </div>
            </div>

            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Document ID</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-tag"></i></div>
                </div>
                <input type="number" class="form-control" name="new_docid" min="0" placeholder="Enter Document ID">
              </div>
            </div>

            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Email</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                </div>
                <input type="email" class="form-control" name="new_email" placeholder="Enter email">
              </div>
            </div>

            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Telephone</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-phone"></i></div>
                </div>
                <input type="text" class="form-control" id="newPhone" name="new_phone" placeholder="Enter Phone number"
                  data-inputmask="'mask':'(999) 999-999-999'" data-mask inputmode="text" required>
              </div>
            </div>

            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Address</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-home"></i></div>
                </div>
                <input type="text" class="form-control" name="new_address" placeholder="Enter address">
              </div>
            </div>

            <div class="col-12 mt-3">
              <button type="submit" class="btn btn-primary mb-2">Save Client</button>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

          <?php
                $add_client = new ClientsController();
                $add_client->store();
            ?>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- EDIT client Modal -->
<div class="modal fade" id="editClient" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header mb-3">
          <h5 class="modal-title" id="exampleModalLabel">Modify client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST">
          <div class="form-row align-items-center">
            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Client's Name</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control" name="edit_name" placeholder="Modify Client's name"
                  id="editName">
                <input type="hidden" id="clientId" name="client_id">
              </div>
            </div>

            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Document ID</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-tag"></i></div>
                </div>
                <input type="number" class="form-control" name="edit_docid" min="0" id="editDocId"
                  placeholder="Modify Document ID">
              </div>
            </div>

            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Email</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                </div>
                <input type="email" class="form-control" name="edit_email" placeholder="Modify email" id="editEmail">
              </div>
            </div>

            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Telephone</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-phone"></i></div>
                </div>
                <input type="text" class="form-control" id="editPhone" name="edit_phone"
                  placeholder="Modify Phone number" data-inputmask="'mask':'(999) 999-999-999'" data-mask
                  inputmode="text" required>
              </div>
            </div>

            <div class="col-auto col-md-10 col-12">
              <label class="sr-only" for="inlineFormInputGroup">Address</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-home"></i></div>
                </div>
                <input type="text" class="form-control" name="edit_address" placeholder="Modify address"
                  id="editAddress">
              </div>
            </div>

            <div class="col-12 mt-3">
              <button type="submit" class="btn btn-primary mb-2">Update client</button>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

          <?php
                $edit_client = new ClientsController();
                $edit_client->update();
            ?>
        </form>
      </div>

    </div>
  </div>
</div>

<?php
$del_client = new ClientsController();
$del_client->destroy();