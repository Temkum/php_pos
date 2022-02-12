$(function () {
  /* Edit client */
  // $(".tables ").on("click", "tbody .editClient-Btn", function () {
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
});
