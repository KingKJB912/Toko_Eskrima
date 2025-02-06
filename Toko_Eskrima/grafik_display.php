<section id="grafik">
    <h2>Grafik Penjualan Per Menu</h2>
    <canvas id="chartMenu"></canvas>

    <script>
        const labels = <?php echo json_encode(array_values($labels)); ?>;
        const datasets = <?php echo json_encode($datasets); ?>;

        // Tentukan warna untuk setiap dataset jika diperlukan
        datasets.forEach((dataset, index) => {
            const colors = [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
            ];
            dataset.borderColor = colors[index % colors.length];
            dataset.backgroundColor = colors[index % colors.length] + '80';  // Transparansi
            dataset.fill = true; // Mengisi area bawah grafik
            dataset.pointBackgroundColor = colors[index % colors.length];
        });

        const ctx = document.getElementById('chartMenu').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',  // Jenis grafik
            data: {
                labels: labels,  // Tanggal
                datasets: datasets  // Data penjualan per menu
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#333',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Terjual',
                            font: {
                                size: 16
                            }
                        },
                        grid: {
                            color: '#e0e0e0',
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal',
                            font: {
                                size: 16
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</section>
