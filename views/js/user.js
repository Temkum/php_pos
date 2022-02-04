$(".new_img").change(function () {
  let image = this.files[0];

  // validate image format
  if (
    image["type"] != "image/jpeg" &&
    image["type"] != "image/png" &&
    image["type"] != "image/jpg"
  ) {
    $(".new_img").val("");

    Swal.fire({
      icon: "error",
      title: "Error uploading image",
      text: "Image type has to be JPEG, JPG or PNG!",
      showConfirmButton: true,
      confirmButtonText: "Close",
    });
    // check img size
  } else if (image["size"] > 5000000) {
    $(".new_img").val("");

    Swal.fire({
      icon: "error",
      title: "Image size error",
      text: "Image size too big. It has to be less than 5Mb!",
      showConfirmButton: true,
      confirmButtonText: "Close",
    });
  } else {
    let imgData = new FileReader();
    imgData.readAsDataURL(image);

    $(imgData).on("load", function (event) {
      let imgRoute = event.target.result;

      $(".preview").attr("src", imgRoute);
    });
  }
});

/* EDIT USER */

$(".editUserBtn").on("click", function () {
  let userId = $(this).attr("userId");

  let data = new FormData();
  data.append("userId", userId);

  $.ajax({
    url: "ajax/users.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      // console.log(response);
      $("#editName").val(response["name"]);
      $("#editUsername").val(response["username"]);
      $("#editRole").html(response["role"]);
      $("#editRole").val(response["role"]);
      $("#currentPwd").val(response["password"]);
      $("#currentPic").val(response["photo"]);

      if (response["photo"] != "") {
        $(".preview").attr("src", response["photo"]);
      }
    },
  });
});

/* User activation */
$(".btn-activate").click(function () {
  let userID = $(this).attr("userId");
  let userStatus = $(this).attr("userStat");

  // update database with ajax
  let data = new FormData();
  data.append("activateId", userID);
  data.append("activateUser", userStatus);

  $.ajax({
    url: "ajax/users.ajax.php",
    method: "POST",
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    dataType: "json",
    success: (response) => {},
  });

  if (userStatus == 0) {
    $(this).removeClass("badge-success");
    $(this).addClass("badge-danger");
    $(this).html("Deactivated");
    $(this).attr("userStat", 1);
  } else {
    $(this).addClass("badge-success");
    $(this).removeClass("badge-danger");
    $(this).html("Active");
    $(this).attr("userStat", 0);
  }
});
