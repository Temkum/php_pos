$(function () {
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
  $("#buyingPrice").change(function () {
    // get value if percentage is checked
    if ($(".percentage").prop("checked")) {
      let percentValue = $(".new-percentage").val();
      let percentage =
        Number(($("#buyingPrice").val() * percentValue) / 100) +
        Number($("#buyingPrice").val());
      $("#salePrice").val(percentage);
      $("#salePrice").prop("readonly", true);
    }
  });

  /* change percentage */
  $(".new-percentage").change(function () {
    if ($(".percentage").prop("checked")) {
      let percentValue = $(".new-percentage").val();
      let percentage =
        Number(($("#buyingPrice").val() * percentValue) / 100) +
        Number($("#buyingPrice").val());
      $("#salePrice").val(percentage);
      $("#salePrice").prop("readonly", true);
    }
  });

  // change value manually if btn is unchecked
  $(".percentage").on("ifUnchecked", function () {
    $("#salePrice").prop("readonly", false);
  });

  $(".percentage").on("ifChecked", function () {
    $("#salePrice").prop("readonly", true);
  });
});
