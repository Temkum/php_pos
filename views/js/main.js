/* data tables */
$(document).ready(function () {
  $(".tables").DataTable({
    responsive: true,
  });

  // icheck plugin
  $("input").iCheck({
    checkboxClass: "icheckbox_flat-yellow",
    radioClass: "iradio_flat-yellow",
    increaseArea: "20%", // optional
  });

  //Datemask for phone number input
  $("#newPhone").inputmask({ mask: "(999) 999-9999" });
});
