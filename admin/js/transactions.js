const allTransactions = Array.from({ length: 30 }, (_, i) => ({
  id: i + 1,
  user: `User ${i + 1}`,
  movie: ["Avatar", "Matrix", "Titanic", "Inception", "Batman"][i % 5],
  date: `2024-06-${((i % 30) + 1).toString().padStart(2, "0")}`,
  type: i % 2 === 0 ? "Subscription" : "Per Movie",
  amount: `${20 + (i % 5) * 10} Tk`,
}));

let filtered = [...allTransactions];
let currentPage = 1;
const perPage = 10;

function renderTransactions() {
  const tbody = document.getElementById("transactionBody");
  tbody.innerHTML = "";
  const start = (currentPage - 1) * perPage;
  const paginated = filtered.slice(start, start + perPage);
  paginated.forEach((t) => {
    tbody.innerHTML += `
      <tr>
        <td>${t.user}</td>
        <td>${t.movie}</td>
        <td>${t.date}</td>
        <td>${t.type}</td>
        <td>${t.amount}</td>
        <td><button class="btn btn-sm btn-danger" onclick="deleteTransaction(${t.id})"><i class="bi bi-trash-fill"></i></button></td>
      </tr>
    `;
  });
  renderPagination();
}

function deleteTransaction(id) {
  if (confirm("Are you sure to delete this transaction?")) {
    const index = allTransactions.findIndex((t) => t.id === id);
    if (index !== -1) {
      allTransactions.splice(index, 1);
      filterTransactions();
    }
  }
}

function filterTransactions() {
  const user = document.getElementById("filterUser").value.toLowerCase();
  const movie = document.getElementById("filterMovie").value.toLowerCase();
  const date = document.getElementById("filterDate").value;

  filtered = allTransactions.filter(
    (t) =>
      t.user.toLowerCase().includes(user) &&
      t.movie.toLowerCase().includes(movie) &&
      (!date || t.date === date)
  );
  currentPage = 1;
  renderTransactions();
}

document
  .getElementById("filterUser")
  .addEventListener("input", filterTransactions);
document
  .getElementById("filterMovie")
  .addEventListener("input", filterTransactions);
document
  .getElementById("filterDate")
  .addEventListener("change", filterTransactions);

function renderPagination() {
  const totalPages = Math.ceil(filtered.length / perPage);
  const pagination = document.getElementById("pagination");
  pagination.innerHTML = "";

  for (let i = 1; i <= totalPages; i++) {
    pagination.innerHTML += `
      <li class="page-item ${i === currentPage ? "active" : ""}">
        <button class="page-link" onclick="goToPage(${i})">${i}</button>
      </li>`;
  }
}

function goToPage(page) {
  currentPage = page;
  renderTransactions();
}

function exportCSV() {
  const rows = ["User,Movie,Date,Type,Amount"];
  filtered.forEach((t) => {
    rows.push(`${t.user},${t.movie},${t.date},${t.type},${t.amount}`);
  });
  const blob = new Blob([rows.join("\n")], { type: "text/csv" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = "transaction_history.csv";
  a.click();
  URL.revokeObjectURL(url);
}

renderTransactions();
