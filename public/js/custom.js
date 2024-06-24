jQuery(".hamburger--section").click(function () {
  jQuery(".navbar--section").toggleClass("full--nav");
  jQuery(".content--section").toggleClass("connect--tog");
});

jQuery(".dropdown--menu").click(function () {
  jQuery(".dropdown--sub--menu").toggleClass("opensubmenu");
  jQuery(".drop--arrow").toggleClass("rotate");
});
jQuery(".bg--box--sec").click(function () {
  jQuery(".edit-view-btn").toggleClass("open--btn");
});


jQuery(document).ready(function () {
  jQuery("#customer-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/customers",
    columns: [
      { data: "id", name: "id" },
      { data: "company_name", name: "company_name" },
      { data: "location_id", name: "location_id" },
      { data: "domains", name: "domains" },
      { data: "webhook_url", name: "webhook_url" },
      { data: "Actions", name: "Actions", orderable: false, searchable: false },
    ],
    order: [[0, "desc"]]
  });
});

jQuery(function () {
  var currentNumber = 1;
  var table = jQuery("#tenants-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: "tenant",
    columns: [
      {
        data: null,
        render: function (data, type, row, meta) {
          return meta.row + 1;
        },
        name: "SN.",
      },
      {
        data: "company_name",
        name: "company_name",
        render: function (data, type, row) {
          var getValueForma = jQuery(data).html();
          return (
            '<div class="ag--box">' +
            '<span class="ag--name-box">' +
            getValueForma.substring(0, 1) +
            "</span>" +
            data +
            "</div>"
          );
        },
      },
      {
        data: "domain",
        name: "URL",
        render: function (data, type, row) {
          if (data) {
            return data;
          } else {
            return "";
          }
        },
      },
    ],
  });
});

jQuery(document).ready(function () {
  jQuery("#plan-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/plans",
    columns: [
      {
        data: null,
        render: function (data, type, row, meta) {
          return meta.row + 1;
        },
        name: "SN.",
      },
      { data: "name", name: "name" },
      { data: "price", name: "price" },
      { data: "billing_period", name: "billing_period" },
      { data: "description", name: "description" },
      { data: "Actions", name: "Actions", orderable: false, searchable: false },
    ],
    order: [[0, "desc"]]
  });
});


$('#choose_agency').select2({
  tags: true,
  tokenSeparators: [",", " "]
});

$('#leads-table th input:checkbox').click(function (e) {
  var table = $(e.target).closest('table'); // Old => var table = $(e.target).parents('table:first');
  $('td input:checkbox', table).prop('checked', e.target.checked);
});


$('#exportCCA').click(function (e) {
  e.preventDefault();

  var selectedLeadIds = [];

  $('#leads-table tbody input:checked').each(function () {
      selectedLeadIds.push($(this).closest('tr').find('td:eq(1)').text());
  });

  if (selectedLeadIds.length > 0) {
      exportLeads(selectedLeadIds);
  } else {
      alert('Please select at least one lead to export.');
  }
});

function exportLeads(selectedLeadIds) {
  $('#selectedLeadIds').val(selectedLeadIds.join(','));

  $('#exportForm').submit();
}

jQuery(document).ready(function () {
  var leadTable = jQuery("#leads-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/leads",

    columns: [
      { data: "checkbox", name: "checkbox", orderable: false, searchable: false },
      { data: "id", name: "id" },
      {
        data: null,
        name: "full_name",
        render: function (data, type, row) {
          return data.first_name + " " + data.last_name;
        },
      },
      { data: "created_at", name: "created_at" },
      { data: "personal_email", name: "personal_email" },
      { data: "contact_metro_city", name: "contact_metro_city" },
      { data: "contact_state", name: "contact_state" },
      { data: "host_name", name: "host_name" },
      { data: "visitor_search_engine", name: "visitor_search_engine" },
      { data: "Actions", name: "Actions", orderable: false, searchable: false },
    ],
    order: [[0, "desc"]]
  });
    $('#leads-table tbody').on('click', 'input[type="checkbox"]', function () {
      var allCheckboxesChecked = $('#leads-table tbody input[type="checkbox"]:checked').length === leadTable.rows().count();

      $('#leads-table th input:checkbox').prop('checked', allCheckboxesChecked);
  });

  $('#leads-table th input:checkbox').click(function () {
      var checked = $(this).prop('checked');
      $('#leads-table tbody input:checkbox').prop('checked', checked);
  });
});


function openleadsModal() {
  document.getElementById("leadsModal").style.display = "flex";

}

function closeleadsModal() {
  document.getElementById("leadsModal").style.display = "none";
}

window.onclick = function (event) {
  var modal = document.getElementById("leadsModal");
  if (event.target === modal) {
    closeModal();
  }
}