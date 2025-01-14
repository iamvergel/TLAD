$(document).ready(function () {
  // Initialize DataTables for each table with export buttons
  $("#dailyTbl").DataTable({
    dom:
      "<'row'<'col-sm-3'l><'col-sm-5'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    processing: true,
    searching: true,
    paging: true,
    responsive: true,
    pagingType: "simple",
    buttons: [
      {
        extend: "copyHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="fas fa-clipboard"></i> Copy',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "csvHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-csv"></i> CSV',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "excelHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-excel"></i> Excel',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "pdfHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-pdf"></i> PDF',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "print",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="fas fa-print"></i> Print',
        exportOptions: {
          columns: ".export",
        },
      },
    ],
  });

  // Similarly, initialize DataTable for weekly, monthly, and yearly tables
  $("#weeklyTbl").DataTable({
    dom:
      "<'row'<'col-sm-3'l><'col-sm-5'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    processing: true,
    searching: true,
    paging: true,
    responsive: true,
    pagingType: "simple",
    buttons: [
      {
        extend: "copyHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="fas fa-clipboard"></i> Copy',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "csvHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-csv"></i> CSV',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "excelHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-excel"></i> Excel',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "pdfHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-pdf"></i> PDF',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "print",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="fas fa-print"></i> Print',
        exportOptions: {
          columns: ".export",
        },
      },
    ],
  });

  $("#monthlyTbl").DataTable({
    dom:
      "<'row'<'col-sm-3'l><'col-sm-5'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    processing: true,
    searching: true,
    paging: true,
    responsive: true,
    pagingType: "simple",
    buttons: [
      {
        extend: "copyHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="fas fa-clipboard"></i> Copy',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "csvHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-csv"></i> CSV',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "excelHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-excel"></i> Excel',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "pdfHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-pdf"></i> PDF',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "print",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="fas fa-print"></i> Print',
        exportOptions: {
          columns: ".export",
        },
      },
    ],
  });

  $("#yearlyTbl").DataTable({
    dom:
      "<'row'<'col-sm-3'l><'col-sm-5'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    processing: true,
    searching: true,
    paging: true,
    responsive: true,
    pagingType: "simple",
    buttons: [
      {
        extend: "copyHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="fas fa-clipboard"></i> Copy',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "csvHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-csv"></i> CSV',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "excelHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-excel"></i> Excel',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "pdfHtml5",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="far fa-file-pdf"></i> PDF',
        exportOptions: {
          columns: ".export",
        },
      },
      {
        extend: "print",
        className: "btn btn-outline-secondary btn-sm",
        text: '<i class="fas fa-print"></i> Print',
        exportOptions: {
          columns: ".export",
        },
      },
    ],
  });

  // Button click events to toggle tables
  $("#btnDaily").click(function () {
    $("#dailyIncome").show();
    $("#weeklyIncome").hide();
    $("#monthlyIncome").hide();
    $("#yearlyIncome").hide();
  });

  $("#btnWeekly").click(function () {
    $("#weeklyIncome").show();
    $("#dailyIncome").hide();
    $("#monthlyIncome").hide();
    $("#yearlyIncome").hide();
  });

  $("#btnMonthly").click(function () {
    $("#monthlyIncome").show();
    $("#dailyIncome").hide();
    $("#weeklyIncome").hide();
    $("#yearlyIncome").hide();
  });

  $("#btnYearly").click(function () {
    $("#yearlyIncome").show();
    $("#dailyIncome").hide();
    $("#weeklyIncome").hide();
    $("#monthlyIncome").hide();
  });
});
