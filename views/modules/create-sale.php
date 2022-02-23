<style>
/* .box-success {
  color: green;
} */
.w-30 {
  width: 30%;
}

.w-50 {
  width: 50%;
}

.w-70 {
  width: 70%;
}

.bold {
  font-weight: bold;
}
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Sale</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Add Sale</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-5 col-xs-12">
            <!-- Sales table -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Add Sale</h4>
              </div>
              <div class="card-body">
                <!-- sales form -->
                <form method="POST" class="sales-form">
                  <div class="form-row align-items-center">
                    <div class="col-12">
                      <label class="sr-only" for="inlineFormInputGroup">Vendor</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-user"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="sale_vendor" id="saleVendor" placeholder="Vendor"
                          value="<?= $_SESSION['name']?>" readonly>
                        <input type="hidden" name="vendor_id" id="vendorId">
                      </div>
                    </div>

                    <div class="col-12">
                      <label class="sr-only" for="inlineFormInputGroup">Billing Code</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-key"></i></div>
                        </div>

                        <?php
                              $item = null;
                              $value = null;
                              $sales = SalesController::display($item, $value);

                        if (!$sales) {
                            echo '<input type="text" class="form-control" name="billing_code" id="billingCode" placeholder="Enter code" value="100001" readonly>';
                        } else {
                            foreach ($this->sales as $key => $sale) {
                                // code...
                            }
                            $code = $sale['code'] + 1;

                            echo '<input type="text" class="form-control" name="billing_code" id="billingCode" placeholder="Enter code" value="'.$code.'" readonly>';
                        }
                        ?>
                      </div>
                    </div>

                    <div class="col-12">
                      <label class="sr-only" for="inlineFormInputGroup">Select Client</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-users"></i>
                          </div>
                        </div>
                        <select class="custom-select" id="selectClient" name="select_client">

                          <?php
                              $item = null;
                              $value = null;
                              $clients = ClientsController::display($item, $value);

                            foreach ($clients as $key => $client) {
                                echo '<option value"'.$client['id'].'">'.$client['name'].'</option>';
                            }
                            ?>
                        </select>
                        <div class="input-group-append">
                          <div class="input-group-text btn" data-toggle="modal" data-target="#addCustomer"
                            data-dismiss="modal">New client</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="row prod-sale-row new-product">

                      </div>

                      <button type="button" class="btn btn-outline-secondary btn-md hidden-lg mb-2 addProduct-btn">Add
                        products</button> <br>
                    </div>

                    <div class="col-12">
                      <div class="row">
                        <div class="input-group mb-2 col-md-6">
                          <div class="input-group-prepend">
                            <div class="input-group-text bold">
                              Taxes
                            </div>
                          </div>
                          <input type="number" class="form-control" placeholder="0.00" min="1" id="newSaleTax"
                            name="new_tax_price" required>

                          <input type="hidden" name="new_tax_price" id="newTaxPrice" required>
                          <input type="hidden" name="new_net_price" id="newNetPrice" required>
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <i class="fas fa-percent"></i>
                            </div>
                          </div>
                        </div>

                        <div class="input-group mb-2 col-md-6">
                          <div class="input-group-prepend">
                            <div class="input-group-text bold">Total</div>
                          </div>
                          <input type="number" class="form-control" placeholder="0.00" min="1" name="new_total_sale"
                            id="newTotalSale" total="" required readonly>

                          <input type="hidden" name="sale_total" id="saleTotal" required>
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <i class="fas fa-dollar-sign"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 payment">
                      <div class="form-group row text-center">
                        <label class="sr-only" for="inlineFormInputGroup">Payment method</label>
                        <div class="col-xs-12 mb-2 mr-2">
                          <div class="input-group">
                            <select class="form-control" name="new_payment_method" id="newPaymentMethod" required>
                              <option>Select payment method</option>
                              <option value="Cash">Cash</option>
                              <option value="CC">Credit Card</option>
                              <option value="DC">Debit Card</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-xs-12 transaction-code">
                          <div class="input-group mb-2 col-auto">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Transaction code" required
                              name="transaction_code" id="transactionCode">
                          </div>
                        </div>
                      </div>

                      <!-- payment boxes -->
                      <div class="payment-box col-xs-12 mb-2">
                        <!-- <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                            <input type="number" class="form-control new-cash-value" placeholder="Transaction Amount"
                              name="new_cash_value" id="newCashValue" required>
                          </div>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                            <input type="text" class="form-control new-cash-change" placeholder="Change"
                              name="new_cash_change" id="newCashChange" readonly required>
                          </div> -->
                      </div>
                    </div>

                    <div class="col-12 mt-3">
                      <button type="submit" class="btn btn-primary mb-2">Add
                        Sale</button>
                    </div>


                  </div><!-- form row end -->
                </form>

              </div><!-- card body end -->
            </div>

          </div>

          <!-- Products table -->
          <div class="col-lg-7 col-xs-12 hidden">
            <div class="card card-warning">
              <div class="card-header ">
                <h4 class="card-title">Products</h4>
              </div>

              <div class="card-body">
                <div class="col-sm-12 table-responsive">
                  <table id="example1"
                    class="table table-bordered table-striped dataTable dtr-inline tables table-sm sales-table"
                    role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting">#</th>
                        <th class="">Code</th>
                        <th class="">Description</th>
                        <th class="">Image</th>
                        <th class="">Stock</th>
                        <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                          aria-label="CSS grade: activate to sort column ascending">Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <!--add products using js -->
                    </tbody>
                  </table>
                </div>
              </div>
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