<x-layout>
    <div class="container py-5">
        <h2 class="mb-4">Admin Dashboard</h2>

        <div class="card p-4 mb-4">
            <a href="{{ route('admin.menus.index') }}" class="btn btn-primary mb-3">Kelola Menu</a>
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary mb-3 ms-2">Kelola Transaksi</a>

            <p>Selamat datang, admin. Gunakan fitur di bawah untuk memantau penjualan dan transaksi bulan terakhir.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-8">
                <div class="card p-3">
                    <h5>Penjualan Mingguan (Satu Bulan Terakhir)</h5>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 mb-3">
                    <h5>Transaksi (Satu Bulan Terakhir)</h5>
                    <canvas id="txnStatusChart"></canvas>
                </div>

                <div class="card p-3">
                    <h5>Menu Terlaris (Satu Bulan Terakhir)</h5>
                    <canvas id="topMenuChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($labels ?? []);
        const salesData = @json($salesData ?? []);
        const txnStatus = @json($txnStatus ?? []);
        const topMenus = @json($topMenus->pluck('namaMenu') ?? []);
        const topMenuQty = @json($topMenus->pluck('total_qty') ?? []);

        // Sales chart (weekly)
        new Chart(document.getElementById('salesChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: salesData,
                    borderColor: '#36A2EB',
                    backgroundColor: 'rgba(54,162,235,0.6)'
                }]
            },
            options: { scales: { y: { beginAtZero: true } }, plugins: { tooltip: { callbacks: { label: function(ctx){ return 'Rp ' + new Intl.NumberFormat('id-ID').format(ctx.raw); } } } } }
        });

        // Transaction status chart
        new Chart(document.getElementById('txnStatusChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(txnStatus),
                datasets: [{
                    data: Object.values(txnStatus),
                    backgroundColor: ['#4BC0C0', '#FF6384']
                }]
            }
        });

        // Top menu chart
        new Chart(document.getElementById('topMenuChart'), {
            type: 'bar',
            data: {
                labels: topMenus,
                datasets: [{
                    label: 'Jumlah Terjual',
                    data: topMenuQty,
                    backgroundColor: '#4BC0C0'
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    </script>
</x-layout>