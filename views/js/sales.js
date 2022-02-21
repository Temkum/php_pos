$(function () {
  /*  $.ajax({
    url: "ajax/datatable_salesAjax.php",
    success: function (response) {
      console.log("response", response);
    },
  }); */

  // data table ex
  $(".sales-table")
    .DataTable({
      ajax: "ajax/datatable_salesAjax.php",
      deferRender: true,
      retrieve: true,
      processing: true,
    })
    .destroy();

  /* add product to the sales from products table */
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

        /* let prodMarkup =
          '<div class="input-group mb-2 col-md-6 col-sm-12">' +
          '<div class="input-group-prepend remove-product btn recover-btn" productId="' +
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
          "<br>"; */

        // check if there's available stock
        if (stock == 0) {
          Swal.fire({
            title: "Out of stock",
            icon: "error",
            confirmButtonText: "Close",
          });
          /* $("div[productId='" + productId + '"]').addClass(
            "btn-primary add-product"
          ); */
          $(`button[productId='${productId}`).addClass(
            "btn-primary add-product"
          );

          return;
        }

        let prodMarkup = `<div class="col-12">
                        <label class="sr-only" for="inlineFormInputGroup">Products</label>
                        <div class="row mb-2">

                          <div class="input-group mb-2 col-md-6 col-sm-12">
                            <div class="input-group-prepend">
                              <div class="input-group-text btn remove_product" productId="${productId}">
                                <i class="fa fa-trash"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control new-prod-desc" name="add_product" productId="${productId}" value="${description}" required>
                          </div>

                          <div class="input-group mb-2 col-md-2 col-sm-3">
                            <input type="number" class="form-control new-prod-qty" name="new_prod_qty" min="1" value="1" stock="${stock}" required>
                          </div>

                          <div class="input-group mb-2 col-md-4 col-xs-8 enter-price">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                              </div>
                            </div>
                            <input type="number" class="form-control new-prod-price" realPrice="" name="new_prod_price" min="1"  value="${price}" readonly required>
                          </div>
                          <br>
                        </div>`;

        $(".new-product").append(prodMarkup);
      },
    });
  });

  // load table during navigation
  $(".sales-table").on("draw.dt", function () {
    if (localStorage.getItem("remove_product") != null) {
      let prodListId = JSON.parse(localStorage.getItem("remove_product"));

      for (let i = 0; i < prodListId.length; i++) {
        $(
          "button.recover-btn[productId='" + prodListId[i]["productId"] + "']"
        ).removeClass("btn-default");
        $(
          "button.recover-btn[productId='" + prodListId[i]["productId"] + "']"
        ).addClass("btn-primary add-product");
      }
    }
  });

  let removeProductId = [];

  localStorage.removeItem("remove_product");

  /* Delete sale product and recover btn */
  $(".sales-form").on("click", "div.remove_product", function () {
    $(this).parent().parent().parent().remove();
    let productId = $(this).attr("productId");

    // store product ID in local storage before we delete
    if (localStorage.getItem("remove_product") == null) {
      removeProductId = [];
    } else {
      removeProductId.concat(localStorage.getItem("remove_product"));
    }
    removeProductId.push("productId", productId);
    localStorage.setItem("remove_product", JSON.stringify(removeProductId));

    // change state of btns
    $("button.recover-btn[productId='" + productId + "']").removeClass(
      "btn-default"
    );
    $("button.recover-btn[productId='" + productId + "']").addClass(
      "btn-primary add-product"
    );
  });

  let productNum = 0;

  /* Add products with btn for smaller devices */
  $(".addProduct-btn").click(function () {
    productNum++;

    let data = new FormData();
    data.append("load_products", "OK");

    $.ajax({
      url: "ajax/products.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        let prodMarkup = `<div class="col-12">
                        <label class="sr-only" for="inlineFormInputGroup">Products</label>
                        <div class="row mb-2">
                          <div class="input-group mb-2 col-md-6 col-sm-12">
                            <div class="input-group-prepend">
                              <div class="input-group-text btn remove_product" productId>
                                <i class="fa fa-trash"></i>
                              </div>
                            </div>
                            <select class=form-control new-prod-desc" productId name="new_prod_desc" id="product${productNum}" required>
                                <option>Select product</option>
                            </select>
                          </div>

                          <div class="input-group mb-2 col-md-2 col-sm-3 enter-qty">
                            <input type="number" class="form-control new-prod-qty" min="1"  value="1" name="new_prod_stock" stock newStock required>
                          </div>

                          <div class="input-group mb-2 col-md-4 col-xs-8 enter-price">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                              </div>
                            </div>
                            <input type="number" class="form-control new-prod-price" readonly name="new_prod_price" realPrice="" required>
                          </div> <br>
                        </div>`;

        $(".new-product").append(prodMarkup);

        // add product to the select element
        response.forEach(foreachFunc);

        function foreachFunc(item, index) {
          if (item.stock != 0) {
            $("#product" + productNum).append(
              '<option value="' +
                item.description +
                '" productId="' +
                item.id +
                '">' +
                item.description +
                "</option>"
            );
          }
        }
      },
    });
  });

  /* Select product */
  $(".sales-form").on("change", "select.new-prod-desc", function () {
    let prodName = $(this).val();

    let newProductDescription = $(this)
      .parent()
      .parent()
      .parent()
      .children()
      .children()
      .children(".new-prod-desc");

    let newProductPrice = $(this)
      .parent()
      .parent()
      .parent()
      .children()
      .children(".enter-price")
      .children()
      .children(".new-prod-price");

    let newProductQuantity = $(this)
      .parent()
      .parent()
      .parent()
      .children()
      .children(".new-prod-qty");

    let data = new FormData();
    data.append("prodName", prodName);

    $.ajax({
      url: "ajax/products.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        $(newProductDescription).attr("productId", response["id"]);
        $(newProductQuantity).attr("stock", response["stock"]);
        $(newProductPrice).val(response["sale_price"]);
        $(newProductPrice).attr("realPrice", response["sale_price"]);
      },
    });
  });

  /* Modify quantity */
  $(".sales-form").on("change", "input.new-prod-qty", function () {
    let price = $(this)
      .parent()
      .parent()
      .children(".enter-price")
      .children()
      .children(".new-prod-price");

    let totalPrice = $(this).val() * price.attr("realPrice");
    price.val(totalPrice);

    // if qty entered is greater than stock, set initial stock value
    if (Number($(this).val()) > Number($(this).attr("stock"))) {
      $(this).val(1);
      let stockCheck = $(this).attr("stock");

      Swal.fire({
        title: "Your quantity is more than available stock",
        text: `Only ${stockCheck} units left!`,
        icon: "error",
        confirmButtonText: "Close",
      });
    }
  });

  // end
});
