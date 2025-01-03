<!-- Begin Page Content -->

<div class="container-fluid">



    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>



    <!-- Content Row -->

    <div class="row">



        <!-- Earnings (Monthly) Card Example -->

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-primary shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

                                Danh thu tháng này </div>

                           <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthly-revenue">Loading...</div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-calendar fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- Earnings (Monthly) Card Example -->

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-success shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">

                                Lợi nhuận tháng này </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="current_profit">Loading...</div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- Earnings (Monthly) Card Example -->

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-info shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> Tỉ lệ

                                hàng tồn kho

                            </div>

                            <div class="row no-gutters align-items-center">

                                <div class="col-auto">

                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">40%</div>

                                </div>

                                <div class="col">

                                    <div class="progress progress-sm mr-2">

                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"

                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- Pending Requests Card Example -->

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-warning shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

                                Số đơn hàng tháng này</div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthly-orders">Loading...</div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Content Row -->



    <div class="row">



        <!-- Area Chart -->

        <div class="col-xl-8 col-lg-7">

            <div class="card shadow mb-4">

                <!-- Card Header - Dropdown -->

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                    <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu</h6>

                    <div class="dropdown no-arrow">

                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"

                            aria-haspopup="true" aria-expanded="false">

                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>

                        </a>

                    </div>

                </div>

                <!-- Card Body -->

                <div class="card-body">

                    <div class="chart-area">

                        <canvas id="myAreaChart"></canvas>

                    </div>

                </div>

            </div>

        </div>



        <!-- Pie Chart -->

        <div class="col-xl-4 col-lg-5">

            <div class="card shadow mb-4">

                <!-- Card Header - Dropdown -->

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                    <h6 class="m-0 font-weight-bold text-primary"> Tỉ lệ danh thu các nhóm mặt hàng</h6>

                </div>

                <!-- Card Body -->

                <div class="card-body">

                    <div class="chart-pie pt-4 pb-2">

                        <canvas id="typeRevenueChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Content Row -->

    <div class="row">





        <div class="col-lg-6 mb-4">



            <!-- Illustrations -->

            <div class="card shadow mb-4">

                <!-- Bar Chart -->

                <div class="card shadow mb-4">

                    <div class="card-header py-3">

                        <h6 class="m-0 font-weight-bold text-primary">Biểu đồ lợi nhuận</h6>

                    </div>

                    <div class="card-body">

                        <div class="chart-bar">

                            <canvas id="myBarChart2"></canvas>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fetch Monthly Revenue
fetch('fetch_monthly_revenue.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('monthly-revenue').textContent = `${data[0]?.revenue || 0}`;
    });

    fetch('fetch_current_profit.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('current_profit').textContent = `$${data.profit || 0}`;
    })
    .catch(error => {
        console.error('Error fetching current profit:', error);
        document.getElementById('current_profit').textContent = "Error";
    });



// Fetch Monthly Orders
fetch('fetch_orders_count.php')
    .then(response => response.json())
    .then(data => {
        console.log('Orders Count API Response:', data); // Log for debugging
        if (data?.order_count) {
            document.getElementById('monthly-orders').textContent = data.order_count;
        } else {
            document.getElementById('monthly-orders').textContent = "No data";
        }
    })
    .catch(error => {
        console.error('Error fetching orders count:', error);
        document.getElementById('monthly-orders').textContent = "Error";
    });

// Fetch and Display Type Revenue Pie Chart
fetch('fetch_type_revenue.php')
    .then(response => response.json())
    .then(data => {
        const labels = data.map(item => item.type);
        const revenues = data.map(item => item.revenue);

        const ctx = document.getElementById('typeRevenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: revenues,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                }],
            },
        });
    });
</script>
