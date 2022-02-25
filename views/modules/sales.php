<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sales</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Sales</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <a href="create-sale">
          <button class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Register Sale
          </button>
        </a>

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
                    <th class="">Billing Code</th>
                    <th class="">Customer</th>
                    <th class="">Payment method</th>
                    <th class="">Sales Person</th>
                    <th class="">Net price</th>
                    <th class="">Total price</th>
                    <th class="">Transaction Date</th>
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
                        $sales = SalesController::display($item, $value);

                        foreach ($sales as $key => $sale) {
                            echo '<tr class="odd">
                          <td class="dtr-control sorting_1" tabindex="0">'.($key + 1).'</td>
                          <td>'.$sale['code'].'</td>';

                          $client_id = 'id';
                          $client_value = $sale['client_id'];
                          $client_data = ClientsController::display($client_id, $client_value);                          
                         echo '<td>'.$client_data['name'].'</td>';

                          $vendor_id = 'id';
                          $vendor_value = $sale['vendor_id'];
                          $vendor_data = UsersController::getUsers($vendor_id, $vendor_value);                           
                         echo '<td>'.$vendor_data['name'].'</td>

                          <td>'.$sale['payment_method'].'</td>
                          <td>'. number_format($sale['net_price'], 2).'</td>
                          <td>'. number_format($sale['total'], 2).'</td>
                          <td>'.$sale['created_at'].'</td>
                          <td class="action">
                                <button class="btn btn-success btn-sm">
                                    <i class="fa fa-print text-white"></i>
                                </button>
                                
                                <button class="btn btn-danger btn-sm">
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