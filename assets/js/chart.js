const ctx = document.getElementById("myChart");

new Chart(ctx, {
  type: "line",
  data: {
    labels: ["Peminjaman", "Pengembalian"],
    datasets: [
      {
        label: "Chart Peminjaman & Pengembalian",
        data: [12, 19],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
