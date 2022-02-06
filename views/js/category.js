$(document).ready(function () {
  /* Edit category */
  $(".editCatBtn").click(function () {
    let categoryId = $(this).attr("catID");

    let data = new FormData();
    data.append("category_id", categoryId);

    $.ajax({
      url: "ajax/categories.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        console.log("response", response);
        $("#editCategory").val(response["category_name"]);
        $("#categoryID").val(response["id"]);
      },
    });
  });
});
