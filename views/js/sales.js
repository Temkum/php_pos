$(function () {
  /*  $.ajax({
    url: "ajax/datatable_salesAjax.php",
    success: function (response) {
      console.log("response", response);
    },
  }); */

  // data table ex
  $(".sales-table").DataTable({
    ajax: "ajax/datatable_salesAjax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
  });

  // add product on sales input
  $(".sales-table tbody").on("click", ".add-product", function () {
    let productId = $(this).attr("productID");

    // make btn inactive
    $(this).removeClass("btn-primary add-product");
    $(this).addClass("btn-default");

    let data = new FormData();
    data.append("productId", productId);

    $.ajax({
      url: "ajax/products.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        let description = response["description"];
        let stock = response["stock"];
        let price = response["sale_price"];

        let prodMarkup =
          '<div class="input-group mb-2 col-md-6 col-sm-12">' +
          '<div class="input-group-prepend remove-product btn" productId="' +
          productId +
          '">' +
          '<div class="input-group-text">' +
          '<i class="fa fa-trash"></i>' +
          "</div>" +
          "</div>" +
          ' <input type="text" class="form-control"  name="product_desc" id="productDesc" value="' +
          description +
          '" placeholder="Product description" required readonly>' +
          "</div>" +
          '<div class="input-group mb-2 col-md-2 col-sm-3">' +
          '<input type="number" class="form-control" value="1" min="1" name="new_stock" stock="' +
          stock +
          '" id="newStock" required>' +
          "</div>" +
          '<div class="input-group mb-2 col-md-4 col-xs-8">' +
          '<div class="input-group-prepend">' +
          '<div class="input-group-text">' +
          '<i class="fas fa-dollar-sign"></i>' +
          "</div>" +
          "</div>" +
          '<input type="number" class="form-control" value="' +
          price +
          '" readonly min="1" required name="new_price" id="newPrice">' +
          "</div>" +
          "</div>" +
          '<button type="button" class="btn btn-outline-secondary btn-md hidden-lg mb-2 addProduct-btn">Add product</button>' +
          "<br>";

        // check if there's available stock
        if (stock == 0) {
          Swal.fire({
            title: "Out of stock",
            icon: "error",
            confirmButtonText: "Close",
          });
          $("button[productId='" + productId + '"]').addClass("btn-primary");
          /* $(`button[productId='${productId[id]["productId"]}`).addClass(
            "btn-primary"
          ); */

          return;
        }

        /* let prodMarkup = `<div class="col-12">
                        <label class="sr-only" for="inlineFormInputGroup">Products</label>
                        <div class="row mb-2">
                          <div class="input-group mb-2 col-md-6 col-sm-12">
                            <div class="input-group-prepend">
                              <div class="input-group-text btn remove-product removeProduct" productId="${productId}">
                                <i class="fa fa-trash"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" name="product_desc" id="productDesc" value="${description}"
                              placeholder="Product description" required>
                          </div>
                          <div class="input-group mb-2 col-md-2 col-sm-3">
                            <input type="number" class="form-control" placeholder="0" min="1" required value="${stock}">
                          </div>
                          <div class="input-group mb-2 col-md-4 col-xs-8">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                              </div>
                            </div>
                            <input type="number" class="form-control" placeholder="0.00" readonly min="1" required vale="${price}">
                          </div>
                          <button type="button"
                            class="btn btn-outline-secondary btn-md hidden-lg mb-2 addProduct-btn">Add
                            products</button> <br>
                        </div>`; */

        $(".prod-sale-row").append(prodMarkup);
      },
    });
  });

  $(".sales-table").on("draw.dt", function () {
    if (localStorage.getItem("removeProduct") != null) {
      let prodListId = JSON.parse(localStorage.getItem("removeProduct"));

      for (let i = 0; i < prodListId.length; i++) {
        $(
          "button.recover-btn[productId='" + prodListId[i]["productId"] + "']"
        ).removeClass("btn-primary");
        $(
          "button.recover-btn[productId='" + prodListId[i]["productId"] + "']"
        ).addClass("btn-primary add-product");
      }
    }
  });

  let removeProductId = [];
  // let removeProduct;

  /* Delete sale product and recover btn */
  $(".sales-form").on("click", ".remove-product", function () {
    $(this).parent().parent().parent().remove();
    let productId = $(this).attr("productId");

    // store product in local storage
    if (localStorage.getItem("removeProduct") == null) {
      removeProductId = [];
    } else {
      removeProductId.concat(localStorage.getItem("removeProduct"));
    }
    removeProduct.push("productId", productId);
    localStorage.setItem("removeProduct", JSON.stringify(removeProductId));

    // change state of btns
    $("button.recover-btn[productId='" + productId + "']").removeClass(
      "btn-primary add-product"
    );
    $("button.recover-btn[productId='" + productId + "']").addClass(
      "btn-primary add-product"
    );
  });
});
