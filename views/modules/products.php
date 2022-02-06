<style>
.percent-checkbox {
  justify-content: center;
}
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
          <i class="fa fa-plus"></i>
          Add Product
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
                    <th class="">Product</th>
                    <th class="">Description</th>
                    <th class="">Category</th>
                    <th class="">Stock</th>
                    <th class="">Sale Price</th>
                    <th class="">Discount Price</th>
                    <th class="">Date Added</th>
                    <th class="" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                      aria-label="CSS grade: activate to sort column ascending">Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0"></td>
                    <td></td>
                    <td></td>
                    <td><img src="views/img/avatar.jpg" alt="Product image" width="50"></td>
                    <td></td>
                    <td class="" userId="" userStat="0">
                    </td>
                    <td class="" userId="" userStat="1">
                    </td>
                    <td></td>
                    <td class="action">
                      <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="" userId="">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-sm" userId="" userPhoto="" userName="">
                        <i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header mb-3">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" enctype="multipart/form-data">
          <div class="form-row align-items-center">

            <div class="col-auto">
              <label class="sr-only" for="inlineFormInputGroup">Product name</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-layer-group"></i></div>
                </div>
                <input type="text" class="form-control" name="new_product" placeholder="Enter Product name">
              </div>
            </div>

            <div class="col-auto">
              <label class="sr-only" for="inlineFormInputGroup">Product Code</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-code"></i></div>
                </div>
                <input type="text" class="form-control" name="new_code" placeholder="Add Product code">
              </div>
            </div>

            <div class="col-auto">
              <label class="sr-only" for="inlineFormInputGroup">Description</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-product"></i></div>
                </div>
                <input type="text" class="form-control" name="new_desc" placeholder="Enter description">
              </div>
            </div>

            <!-- <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" rows="3" cols="30" placeholder="Enter description"></textarea>
            </div> -->

            <div class="col-auto">
              <label class="sr-only" for="inlineFormInputGroup">Category</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-th"></i></div>
                </div>
                <select class="custom-select" name="role">
                  <option selected>Select Category</option>
                  <option value="suit">Suit</option>
                  <option value="women">Women</option>
                  <option value="men">Men</option>
                  <option value="children">Children</option>
                </select>
              </div>
            </div>

            <div class="col-auto">
              <label class="sr-only" for="inlineFormInputGroup">Stock</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-check"></i></div>
                </div>
                <input type="number" class="form-control" name="new_stock" min="0" placeholder="Enter Stock amount">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Cost Price</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-arrow-up"></i></div>
                  </div>
                  <input type="number" class="form-control" name="new_price" placeholder="Add product price" min="0">
                </div>
              </div>

              <div class="col-md-6 col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Sale price</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-arrow-down"></i></div>
                  </div>
                  <input type="number" class="form-control" name="new_saleprice" placeholder="Add Sale price" min="0">
                </div>
              </div>

              <!-- percentage checkbox -->
              <div class="percent-checkbox input-group">
                <div class="col-4 text-center form-check">
                  <div class="form-group">
                    <input type="checkbox" class="check percentage" checked>
                  </div>
                </div>
                <div class="col-4">
                  <div class="input-group mb-2">
                    <input type="number" class="form-control new-percentage" min="0" value="40" required>
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-percent"></i></div>
                    </div>

                  </div>
                </div>
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
              <button type="submit" class="btn btn-primary mb-2">Add Product</button>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

          <?php
                // $product = new ProductsController();
                // $product->store();
            ?>
        </form>
      </div>

    </div>
  </div>
</div>