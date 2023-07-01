<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; AiLab</p>
        </div>
        <div class="float-end">
            <!-- <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                href="https://saugi.me">Saugi</a></p> -->
        </div>
    </div>
</footer>
</div>
</div>

<!-- kalender -->
<script src="../assets/js/kalender.js"></script>

<!-- chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const chartData = [{
        day: 'Mon',
        chart: {
            peminjaman: 500,
            pengembalian: 200
        }
    },
    {
        day: 'Tue',
        chart: {
            peminjaman: 300,
            pengembalian: 300
        }
    },
    {
        day: 'Wed',
        chart: {
            peminjaman: 400,
            pengembalian: 500
        }
    },
    {
        day: 'Thu',
        chart: {
            peminjaman: 600,
            pengembalian: 100
        }
    },
    {
        day: 'Fri',
        chart: {
            peminjaman: 600,
            pengembalian: 300
        }
    },
    {
        day: 'Sat',
        chart: {
            peminjaman: 700,
            pengembalian: 200
        }
    },
    {
        day: 'Sun',
        chart: {
            peminjaman: 900,
            pengembalian: 100
        }
    }
];
// setup 
const data = {
    datasets: [{
        label: 'Peminjaman',
        data: chartData,
        backgroundColor: 'rgba(255, 26, 104, 0.2)',
        borderColor: 'rgba(255, 26, 104, 1)',
        tension: 0.4,
        parsing: {
            xAxisKey: 'day',
            yAxisKey: 'chart.peminjaman'
        }
    }, {
        label: 'Pengembalian',
        data: chartData,
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        tension: 0.4,
        parsing: {
            xAxisKey: 'day',
            yAxisKey: 'chart.pengembalian'
        }
    }]
};

// config 
const config = {
    type: 'line',
    data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// render init block
const myChart = new Chart(
    document.getElementById('myChart'),
    config
);

// Instantly assign Chart.js version
const chartVersion = document.getElementById('chartVersion');
chartVersion.innerText = Chart.version;
</script>

<script src="assets/js/bootstrap.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="assets/js/pages/simple-datatables.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<?php include_once "app_ajax.php" ?>