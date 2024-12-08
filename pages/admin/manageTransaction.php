<!-- Begin Page Content -->
<div class="container-fluid ">
    <form class="form-inline my-2 my-lg-0 w-100" id="search-form">
        <input class="form-control flex-grow-1 mr-sm-2" type="text" id="search-userId" placeholder="User ID"
            aria-label="Search by User ID">

        <input class="form-control flex-grow-1 mr-sm-2" type="text" id="search-orderId" placeholder="Order ID"
            aria-label="Search by Order ID">


        <div class="d-flex align-items-center flex-grow-1 mr-sm-2">
            <p class="mb-0 mr-2">from</p>
            <input class="form-control" type="date" id="search-startDate" placeholder="Start Date"
                aria-label="Search by Start Date">
            <p class="mb-0 mr-2 ml-2">to</p>
            <input class="form-control" type="date" id="search-endDate" placeholder="End Date"
                aria-label="Search by End Date">
        </div>

        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>

    <table class="table mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">orderId</th>
                <th scope="col">userId</th>
                <th scope="col">productId</th>
                <th scope="col">orderdate</th>
                <th scope="col">price_sell</th>
                <th scope="col">quantity</th>
            </tr>
        </thead>
        <tbody id="table-body">
        </tbody>
    </table>
</div>

<script>
document.getElementById("search-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const userId = document.getElementById("search-userId").value;
    const orderId = document.getElementById("search-orderId").value;
    const startDate = document.getElementById("search-startDate").value;
    const endDate = document.getElementById("search-endDate").value;

    loadOrders(userId, orderId, startDate, endDate);
});

function loadOrders(userId, orderId, startDate, endDate) {
    let url = 'fetchOrders.php?';

    if (userId) {
        url += 'userId=' + encodeURIComponent(userId) + '&';
    }
    if (orderId) {
        url += 'orderId=' + encodeURIComponent(orderId) + '&';
    }
    if (startDate) {
        url += 'startDate=' + encodeURIComponent(startDate) + '&';
    }
    if (endDate) {
        url += 'endDate=' + encodeURIComponent(endDate) + '&';
    }

    fetch(url)
        .then(response => response.json())
        .then(orders => {
            const tableBody = document.getElementById('table-body');
            tableBody.innerHTML = '';

            orders.forEach((order, index) => {
                const row = `
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td>${order.orderId}</td>
                        <td>${order.userId}</td>
                        <td>${order.productId}</td>
                        <td>${order.orderdate}</td>
                        <td>${order.price_sell}</td>
                        <td>${order.quantity}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error loading orders:', error));
}
window.onload = function() {
    loadOrders("", "", "", "");
}
</script>