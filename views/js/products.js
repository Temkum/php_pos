$(document).ready(function () {
  // verify format
  /* $.ajax({
    url: "ajax/datatable_productsAjax.php",
    success: function (response) {
      console.log("response", response);
    },
  }); */

  // data table ex
  $(".products-table")
    .DataTable({
      ajax: "ajax/datatable_productsAjax.php",
    })
    .destroy();

  // get category id
  $("#prodCategory").change(function () {
    let categoryId = $(this).val();
    let data = new FormData();
    data.append("categoryId", categoryId);

    $.ajax({
      url: "ajax/products.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (!response) {
          let newCode = categoryId + "01";
          $("#newCode").val(newCode);
        } else {
          let newCode = Number(response["code"]) + 1;
          $("#newCode").val(newCode);
        }
      },
    });
  });

  /* buying price & change percentage of buying price */
  $("#buyingPrice, #editBuyingPrice").change(function () {
    // get value if percentage is checked
    if ($(".percentage").prop("checked")) {
      let percentValue = $(".new-percentage").val();
      let percentage =
        Number(($("#buyingPrice").val() * percentValue) / 100) +
        Number($("#buyingPrice").val());

      let editPercentage =
        Number(($("#editBuyingPrice").val() * percentValue) / 100) +
        Number($("#editBuyingPrice").val());

      $("#salePrice").val(percentage);
      $("#salePrice").prop("readonly", true);

      $("#editSalePrice").val(editPercentage);
      $("#editSalePrice").prop("readonly", true);
    }
  });

  /* change percentage */
  $(".new-percentage").change(function () {
    if ($(".percentage").prop("checked")) {
      let percentValue = $(this).val();
      let percentage =
        Number(($("#buyingPrice").val() * percentValue) / 100) +
        Number($("#buyingPrice").val());

      let editPercentage =
        Number(($("#editBuyingPrice").val() * percentValue) / 100) +
        Number($("#editBuyingPrice").val());

      $("#salePrice").val(percentage);
      $("#salePrice").prop("readonly", true);

      $("#editSalePrice").val(editPercentage);
      $("#editSalePrice").prop("readonly", true);
    }
  });

  // change value manually if btn is unchecked
  $(".percentage").on("ifUnchecked", function () {
    $("#salePrice").prop("readonly", false);
    $("#editSalePrice").prop("readonly", false);
  });

  $(".percentage").on("ifChecked", function () {
    $("#editSalePrice").prop("readonly", true);
    $("#salePrice").prop("readonly", true);
  });

  /* MODIFY product */
  $(".products-table tbody").on("click", "button.editProd-btn", function () {
    let productId = $(this).attr("productID");
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
        let categoryData = new FormData();
        categoryData.append("category_id", response["category_id"]);

        $.ajax({
          url: "ajax/categories.ajax.php",
          method: "POST",
          data: categoryData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (response) {
            $("#editCat").val(response["id"]);
            $("#editCat").html(response["category_name"]);
          },
        });

        $("#editCode").val(response["code"]);
        $("#editDesc").val(response["description"]);
        $("#editStock").val(response["stock"]);
        $("#editBuyingPrice").val(response["buying_price"]);
        $("#editSalePrice").val(response["sale_price"]);
        if (response["image"] != "") {
          $("#oldImage").val(response["image"]);
          $(".preview").attr("src", response["image"]);
        }
      },
    });
  });
});
