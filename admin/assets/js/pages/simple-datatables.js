let dataTable = new simpleDatatables.DataTable(
  document.getElementById("table1")
);
// Move "per page dropdown" selector element out of label
// to make it work with bootstrap 5. Add bs5 classes.
function adaptPageDropdown() {
  const selector = dataTable.wrapper.querySelector(".dataTable-selector");
  selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
  selector.classList.add("form-select");
}

// Add bs5 classes to pagination elements
function adaptPagination() {
  const paginations = dataTable.wrapper.querySelectorAll(
    "ul.dataTable-pagination-list"
  );

  for (const pagination of paginations) {
    pagination.classList.add(...["pagination", "pagination-primary"]);
  }

  const paginationLis = dataTable.wrapper.querySelectorAll(
    "ul.dataTable-pagination-list li"
  );

  for (const paginationLi of paginationLis) {
    paginationLi.classList.add("page-item");
  }

  const paginationLinks = dataTable.wrapper.querySelectorAll(
    "ul.dataTable-pagination-list li a"
  );

  for (const paginationLink of paginationLinks) {
    paginationLink.classList.add("page-link");
  }
}

// Patch "per page dropdown" and pagination after table rendered
dataTable.on("datatable.init", function () {
  adaptPageDropdown();
  adaptPagination();
});

// Re-patch pagination after the page was changed
dataTable.on("datatable.page", adaptPagination);

let dataTable1 = new simpleDatatables.DataTable(
  document.getElementById("table2")
);
// Move "per page dropdown" selector element out of label
// to make it work with bootstrap 5. Add bs5 classes.
function adaptPageDropdown() {
  const selector = dataTable1.wrapper.querySelector(".dataTable1-selector");
  selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
  selector.classList.add("form-select");
}

// Add bs5 classes to pagination elements
function adaptPagination() {
  const paginations = dataTable1.wrapper.querySelectorAll(
    "ul.dataTable-pagination-list"
  );

  for (const pagination of paginations) {
    pagination.classList.add(...["pagination", "pagination-primary"]);
  }

  const paginationLis = dataTable1.wrapper.querySelectorAll(
    "ul.dataTable-pagination-list li"
  );

  for (const paginationLi of paginationLis) {
    paginationLi.classList.add("page-item");
  }

  const paginationLinks = dataTable1.wrapper.querySelectorAll(
    "ul.dataTable-pagination-list li a"
  );

  for (const paginationLink of paginationLinks) {
    paginationLink.classList.add("page-link");
  }
}

// Patch "per page dropdown" and pagination after table rendered
dataTable1.on("datatable.init", function () {
  adaptPageDropdown();
  adaptPagination();
});

// Re-patch pagination after the page was changed
dataTable1.on("datatable.page", adaptPagination);
