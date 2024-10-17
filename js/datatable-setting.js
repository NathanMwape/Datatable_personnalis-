$(document).ready(function () {
  $(".data-table").DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    pagingType: "simple_numbers",
    columnDefs: [
      {
        targets: "datatable-nosort",
        orderable: false,
      },
    ],
    dom: '<"top-toolbar d-flex justify-content-between"<"length-menu-container"l><""B><"search-container"f>>rtip',
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "Tous"],
    ],
    language: {
      info: "_START_-_END_ de _TOTAL_ entrées",
      infoEmpty: "Affichage de 0 à 0 sur 0 entrées",
      infoFiltered: "(filtre de _MAX_ entrées totales)",
      zeroRecords: "Aucun enregistrement correspondant trouvé",
      search: "Recherche :",
      lengthMenu: "Afficher _MENU_ entrées",
      searchPlaceholder: "Recherche...",
      paginate: {
        next: '<i class="fas fa-chevron-right"></i>', // Utilisation de Font Awesome pour "Suivant"
        previous: '<i class="fas fa-chevron-left"></i>', // Utilisation de Font Awesome pour "Précédent"
      },
    },
  });

 // Table avec boutons d'exportation
 $(".data-table-export").each(function () {
  var table = $(this);
  var tableTitle = table.data("title");
  var fileName = table.data("filename");

  table.DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    pagingType: "simple_numbers",
    dom: '<"top-toolbar d-flex justify-content-between"<"search-container"f><"length-menu-container"l><""B>>rtip', // Boutons inclus
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "Tous"],
    ],
    language: {
      info: "_START_-_END_ de _TOTAL_ entrées",
      infoEmpty: "Affichage de 0 à 0 sur 0 entrées",
      infoFiltered: "(filtre de _MAX_ entrées totales)",
      zeroRecords: "Aucun enregistrement correspondant trouvé",
      search: "Recherche :",
      lengthMenu: "Afficher _MENU_ entrées",
      searchPlaceholder: "Recherche...",
      paginate: {
        next: '<i class="fas fa-chevron-right"></i>',
        previous: '<i class="fas fa-chevron-left"></i>',
      },
    },
    buttons: [
      {
        extend: "csv",
        title: tableTitle,
        filename: fileName,
        footer: true,
        exportOptions: {
          columns: ":not(.no-export)",
        },
        className: "btn-sm",
      },
      {
        extend: "excel",
        title: tableTitle,
        filename: fileName,
        footer: true,
        exportOptions: {
          columns: ":not(.no-export)",
        },
        className: "btn-sm",
      },
      {
        extend: "pdf",
        title: tableTitle,
        filename: fileName,
        footer: true,
        exportOptions: {
          columns: ":not(.no-export)",
        },
        className: "btn-sm",
      },
    ],
  });
});

// Table sans boutons d'exportation
$(".data-table-no-export").DataTable({
  scrollCollapse: true,
  autoWidth: false,
  responsive: true,
  pagingType: "simple_numbers",
  dom: '<"top-toolbar d-flex justify-content-between"<"search-container"f><"length-menu-container"l>>rtip', // Sans boutons
  lengthMenu: [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "Tous"],
  ],
  language: {
    info: "_START_-_END_ de _TOTAL_ entrées",
    infoEmpty: "Affichage de 0 à 0 sur 0 entrées",
    infoFiltered: "(filtre de _MAX_ entrées totales)",
    zeroRecords: "Aucun enregistrement correspondant trouvé",
    search: "Recherche :",
    lengthMenu: "Afficher _MENU_ entrées",
    searchPlaceholder: "Recherche...",
    paginate: {
      next: '<i class="fas fa-chevron-right"></i>',
      previous: '<i class="fas fa-chevron-left"></i>',
    },
  },
});
});
