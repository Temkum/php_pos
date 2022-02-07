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
});
