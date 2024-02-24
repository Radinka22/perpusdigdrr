<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Peminjaman Buku</title>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 300px; /* Atur lebar sesuai kebutuhan Anda */
            height: 200px; /* Atur tinggi sesuai kebutuhan Anda */
            border: 1px solid #ccc; /* Tambahkan border sesuai keinginan */
            padding: 10px; /* Tambahkan padding untuk menjaga jarak antara border dan diagram */
        }
    </style>
</head>
<body>

<h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                    <?php
                                        echo mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM kategori"));
                                    ?>
                                    total kategori</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=kategori">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                    <?php
                                        echo mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM buku"));
                                    ?>
                                    total buku</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=buku">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                    <?php
                                        echo mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM user"));
                                    ?>
                                    total user</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=user">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        

                            </div>
                            <div class="col-xl-13">
                                <div class="card mb-1">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Statistik Peminjam Buku
                                    </div>
                                    <div class="card-body"><canvas id="myChart" width="500" height="250"></canvas>

                        <?php

                        // Query untuk mengambil data peminjaman buku
                        $sql = "SELECT buku.judul AS nama_buku, COUNT(peminjaman.bukuID) AS jumlah_peminjaman 
                        FROM peminjaman 
                        INNER JOIN buku ON peminjaman.bukuID = buku.bukuID 
                        GROUP BY peminjaman.bukuID";
                        $result = $koneksi->query($sql);

                        $labels = [];
                        $data = [];

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $labels[] = $row['nama_buku'];
                                $data[] = $row['jumlah_peminjaman'];
                            }
                        }
                        ?>

                        <script>
                            // Membuat diagram batang
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: <?php echo json_encode($labels); ?>,
                                    datasets: [{
                                        label: 'Jumlah Peminjaman Buku',
                                        data: <?php echo json_encode($data); ?>,
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script></canvas>
                        </div>
                                </div>
                            </div>
                        </div>
                       

</body>
</html>
</div>
