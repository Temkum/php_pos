$(function () {
  /* Edit client */
  $(".editClient-Btn").on("click", function () {
    let clientId = $(this).attr("clientID");

    let data = new FormData();
    data.append("clientId", clientId);

    $.ajax({
      url: "ajax/clients.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        $("#clientId").val(response["id"]);
        $("#editName").val(response["name"]);
        $("#editDocId").val(response["document_id"]);
        $("#editEmail").val(response["email"]);
        $("#editPhone").val(response["phone"]);
        $("#editAddress").val(response["address"]);
      },
    });
  });

  // delete client
  $(".delClient-Btn").on("click", function () {
     let clientId = $(this).attr("clientID");

    Swal.fire({
      title: "Are you sure you want to delete client?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      cancelButtonText: "Cancel",
      confirmButtonText: "Yes, delete client!",
    }).then(function (result) {
      if (result.value) {
        window.location = `index.php?route=clients&clientId=${clientId}`;
      }
    });
  });

});
