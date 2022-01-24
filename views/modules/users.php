<div class="content-wrapper">
    <style>
    .modal-title {
        text-transform: uppercase;
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
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
                        <div class="col-sm-12 col-md-6">
                            <div class="dt-buttons btn-group flex-wrap"> <button
                                    class="btn btn-secondary buttons-copy buttons-html5" tabindex="0"
                                    aria-controls="example1" type="button"><span>Copy</span></button> <button
                                    class="btn btn-secondary buttons-csv buttons-html5" tabindex="0"
                                    aria-controls="example1" type="button"><span>CSV</span></button> <button
                                    class="btn btn-secondary buttons-excel buttons-html5" tabindex="0"
                                    aria-controls="example1" type="button"><span>Excel</span></button> <button
                                    class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0"
                                    aria-controls="example1" type="button"><span>PDF</span></button> <button
                                    class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1"
                                    type="button"><span>Print</span></button>
                                <div class="btn-group"><button
                                        class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis"
                                        tabindex="0" aria-controls="example1" type="button" aria-haspopup="true"
                                        aria-expanded="false"><span>Column visibility</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                        class="form-control form-control-sm" placeholder=""
                                        aria-controls="example1"></label></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">#</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                            rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Username
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Image</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Role</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Status
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Last
                                            Seen</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">1</td>
                                        <td>Super Admin</td>
                                        <td>admin</td>
                                        <td> <img src="views/img/avatar.jpg" alt="User image" width="50"></td>
                                        <td>Admin</td>
                                        <td class="badge badge-success">Active</td>
                                        <td>01/22/2022</td>
                                        <td class="action">
                                            <button class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">1</td>
                                        <td>Admin</td>
                                        <td>admin</td>
                                        <td> <img src="views/img/avatar.jpg" alt="User image" width="50"></td>
                                        <td>Admin</td>
                                        <td class="badge badge-danger">Deactivated</td>
                                        <td>01/22/2022</td>
                                        <td class="action">
                                            <button class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">1</td>
                                        <td>Another user</td>
                                        <td>user</td>
                                        <td> <img src="views/img/avatar.jpg" alt="User image" width="50"></td>
                                        <td>Admin</td>
                                        <td class="badge badge-success">Active</td>
                                        <td>01/22/2022</td>
                                        <td class="action">
                                            <button class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1
                                to 10 of 57 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="example1_previous"><a
                                            href="#" aria-controls="example1" data-dt-idx="0" tabindex="0"
                                            class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="example1"
                                            data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                            data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                            data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                            data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                            data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="example1"
                                            data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                    <li class="paginate_button page-item next" id="example1_next"><a href="#"
                                            aria-controls="example1" data-dt-idx="7" tabindex="0"
                                            class="page-link">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                Footer
            </div>
        </div>
    </section>
</div>

<!-- Add user Modal -->
<div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInputGroup">Name</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" name="name"
                                    placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInputGroup">Username</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-key"></i></div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup" name="username"
                                    placeholder="Enter username">
                            </div>
                        </div>

                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInputGroup">Password</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="password" class="form-control" id="inlineFormInputGroup" name="password"
                                    placeholder="Enter password">
                            </div>
                        </div>

                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInputGroup">Role</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user-tag"></i></div>
                                </div>
                                <select class="custom-select" id="inputGroupSelect01" name="role">
                                    <option selected>Choose role</option>
                                    <option value="admin">Administrator</option>
                                    <option value="cashier">Cashier</option>
                                    <option value="vendor">Vendor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInputGroup">Image</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-image"></i></div>
                                </div>
                                <input type="file" class="form-control" id="inlineFormInputGroup" name="profile-img"
                                    placeholder="Select profile image">
                            </div>
                            <p>Max image size is 10MB</p>
                            <img src="views/img/avatar.jpg" alt="" width="50" class="img-thumbnail">
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>