/* data tables */
$(document).ready(function () {
  $(".tables").DataTable();

  // icheck plugin
  $("input").iCheck({
    checkboxClass: "icheckbox_flat-yellow",
    radioClass: "iradio_flat-yellow",
    increaseArea: "20%", // optional
  });
});
