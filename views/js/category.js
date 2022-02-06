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
        // console.log("response", response);
        $("#editCategory").val(response["category_name"]);
        $("#categoryID").val(response["id"]);
      },
    });
  });

  /* Delete category */
  $(".delCatBtn").on("click", function () {
    let categoryId = $(this).attr("catID");

    Swal.fire({
      title: "Are you sure you want to delete the category?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      cancelButtonText: "Cancel",
      confirmButtonText: "Yes, delete category!",
    }).then(function (result) {
      if (result.value) {
        window.location = `index.php?route=categories&categoryId=${categoryId}`;
      }
    });
  });
});
