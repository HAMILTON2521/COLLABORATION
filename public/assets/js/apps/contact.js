$(function () {
  function checkall(clickchk, relChkbox) {
    var checker = $("#" + clickchk);
    var multichk = $("." + relChkbox);

    checker.click(function () {
      multichk.prop("checked", $(this).prop("checked"));
      $(".show-btn").toggle();
    });
  }

  checkall("contact-check-all", "contact-chkbox");

  $("#input-search").on("keyup", function () {
    var rex = new RegExp($(this).val(), "i");
    $(".search-table .search-items:not(.header-item)").hide();
    $(".search-table .search-items:not(.header-item)")
      .filter(function () {
        return rex.test($(this).text());
      })
      .show();
  });

  $("#btn-add-contact").on("click", function (event) {
    $("#addContactModal").modal("show");
  });

  function deleteContact() {
    $(".delete").on("click", function (event) {
      event.preventDefault();
      /* Act on the event */
      //$(this).parents(".search-items").remove();
    });
  }

  $(".delete-multiple").on("click", function () {
    var inboxCheckboxParents = $(".contact-chkbox:checked").parents(
      ".search-items"
    );
    inboxCheckboxParents.remove();
  });

  // deleteContact();
  // addContact();
  // editContact();
});
