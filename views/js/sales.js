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

  /* Add product to the sales from products table */
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

        // check if there's available stock
        if (stock == 0) {
          Swal.fire({
            title: "Out of stock",
            icon: "error",
            confirmButtonText: "Close",
          });
          $("div[productId='" + productId + '"]').addClass(
            "btn-primary add-product"
          );
          /* $(`button[productId='${productId}`).addClass(
            "btn-primary add-product"
          ); */

          return;
        }

        let prodMarkup = `
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
                            <input type="number" class="form-control new-prod-qty" name="new_prod_qty" min="1" value="1" stock="${stock}" newStock="${stock}" required>
                          </div>

                          <div class="input-group mb-2 col-md-4 col-xs-8 enter-price">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                              </div>
                            </div>
                            <input type="number" class="form-control new-prod-price" realPrice="${price}" name="new_prod_price" min="1"  id="prodPrice" value="${price}" readonly required>
                          </div>
                          <br>
                        `;

        $(".new-product").append(prodMarkup);

        // Add total prod prices
        grandTotal();
        // tax
        saleTax();

        // group prods in json
        listProduct();

        // $(".new-prod-price").NumBox();
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

    if ($(".col-12.prod-sale-row").children().length == 0) {
      $("#newSaleTax").val("");
      $("#newTotalSale").val(0);
      $("#newTotalSale").attr("total", 0);
    } else {
      // Add total prod prices
      grandTotal();

      // Tax
      saleTax();

      listProduct();
    }
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
        let prodMarkup = `
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
                            <input type="number" class="form-control new-prod-qty" min="1"  value="1" name="new_prod_stock" stock="${stock}" newStock="${stock}" required>
                          </div>

                          <div class="input-group mb-2 col-md-4 col-xs-8 enter-price">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                              </div>
                            </div>
                            <input type="number" class="form-control new-prod-price" readonly name="new_prod_price" realPrice="" required>
                          </div> <br>
                       `;

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
        // Add total prod prices
        grandTotal();

        // Add tax
        saleTax();

        listProduct();

        // set number format
        // $("prodPrice").NumBox();
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
        $(newProductQuantity).attr("stock", Number(response["stock"]) - 1);
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

    let newStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("newStock", newStock);

    // if qty entered is greater than stock, set initial stock value
    if (Number($(this).val()) > Number($(this).attr("stock"))) {
      $(this).val(1);

      let stockCheck = $(this).attr("stock");

      let finalPrice = $(this).val() * price.attr("realPrice");

      price.val(finalPrice);

      grandTotal();

      Swal.fire({
        title: "Your quantity is more than available stock",
        text: `Only ${stockCheck} units left!`,
        icon: "error",
        confirmButtonText: "Close",
      });
    }

    // Add total prod prices
    grandTotal();
    // tax
    saleTax();

    listProduct();
  });

  /* Add total product prices */
  function grandTotal() {
    let itemPrice = $(".new-prod-price");
    let priceArr = [];

    for (let i = 0; i < itemPrice.length; i++) {
      priceArr.push(Number($(itemPrice[i]).val()));
    }

    function addPricesArr(totalSale, numberArray) {
      return totalSale + numberArray;
    }

    let totalPriceSum = priceArr.reduce(addPricesArr);

    $("#newTotalSale").val(totalPriceSum);
    $("#newTotalSale").attr("total", totalPriceSum);
  }

  /* TAX */
  function saleTax() {
    let tax = $("#newSaleTax").val();
    let totalPrice = $("#newTotalSale").attr("total");

    let priceTax = Number((totalPrice * tax) / 100);
    let totalWithTax = Number(priceTax + Number(totalPrice));

    $("#newTotalSale").val(totalWithTax);
    $("#newTaxPrice").val(priceTax);
    $("#newNetPrice").val(totalPrice);
  }

  /* Change total on tax change */
  $("#newSaleTax").change(function () {
    saleTax();
  });

  // numbox format
  // $(".new-prod-price").NumBox();

  /* Payment method */
  $("#newPaymentMethod").change(function () {
    let method = $(this).val();

    if (method == "Cash") {
      $(this).parent().parent().removeClass("payment");
      $(this).parent().parent().addClass("col-xs-4");
      $(this).parent().parent().parent().addClass("payment-box")
        .html(`<div class="input-group mb-2 col-md-6">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                  </div>
                  <input type="number" class="form-control new-cash-value" placeholder="Transaction Amount" name="new_cash_value" id="newCashValue" required>
                </div>
                <div class="input-group mb-2 col-md-6" id="getCashChange">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                  </div>
                  <input type="text" class="form-control new-cash-change" placeholder="Change" name="new_cash_change" id="newCashChange" readonly required>
                </div>
                `);
    } else {
      $(this).parent().parent().removeClass("transaction-code");
      $(this).parent().parent().addClass("col-xs-4");
      $(this).parent().parent().parent().addClass("payment-box")
        .html(`<div class="col-xs-12">
                  <div class="input-group mb-2 col-auto">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-lock"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Transaction code" required
                      name="transaction_code" id="transactionCode">
                  </div>
                </div>`);
    }
  });

  /* Cash change */
  $(".sales-form").on("change", "input.new-cash-value", function () {
    let cash = $(this).val();
    let change = Number(cash) - Number($("#saleTotal").val());
    let newCashChange = $(this)
      .parent()
      .parent()
      .parent()
      .children("#getCashChange")
      .children()
      .children("#newCashChange");

    newCashChange.val(change);
  });

  /* List products */
  function listProduct() {
    let productsList = [];
    let description = $(".new-prod-desc");
    let quantity = $(".new-prod-qty");

    let price = $(".new-prod-price");

    for (let i = 0; i < description.length; i++) {
      productsList.push({
        id: $(description[i]).attr("productId"),
        description: $(description[i]).val(),
        quantity: $(quantity[i]).val(),
        stock: $(quantity[i]).attr("newStock"),
        price: $(price[i]).attr("realPrice"),
        totalPrice: $(price[i]).val(),
      });
    }

    $("#productsList").val(JSON.stringify(productsList));
  }
}); // end
