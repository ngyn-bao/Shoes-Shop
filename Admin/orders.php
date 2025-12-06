<?php
// orders.php
$api = '../api/Order/';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng - Shoes Shop Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./img/Admin-icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .page-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .col-id {
            width: 10%;
            text-align: center;
        }

        .col-total {
            width: 18%;
            text-align: right;
        }

        .col-date {
            width: 18%;
            text-align: center;
        }

        .col-status {
            width: 24%;
            text-align: center;
        }

        .col-action {
            width: 30%;
            text-align: center;
        }

        .status-pending {
            background: #ffc107;
            color: #000;
        }

        .status-processing {
            background: #0d6efd;
            color: #fff;
        }

        .status-shipped {
            background: #198754;
            color: #fff;
        }

        .status-delivered {
            background: #28a745;
            color: #fff;
        }

        .status-cancelled {
            background: #dc3545;
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 70px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            opacity: 0.5;
        }
    </style>
</head>

<body class="p-4">
    <div class="container-fluid">
        <h2 class="page-title mb-4">Quản lý đơn hàng</h2>
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="ordersTable">
                        <thead class="table-primary text-dark">
                            <tr>
                                <th class="col-id">Mã đơn</th>
                                <th class="col-total">Tổng tiền</th>
                                <th class="col-date">Ngày đặt</th>
                                <th class="col-status">Trạng thái</th>
                                <th class="col-action">Hành động</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="empty-state d-none" id="emptyState">
                        <i class="bi bi-cart-x"></i>
                        <h4 class="mt-3">Chưa có đơn hàng nào</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const api = '<?= $api ?>';

        async function loadOrders() {
            try {
                const res = await fetch(api + 'getAllOrder.php');
                const json = await res.json();
                if (!json.success) throw new Error(json.message || 'Lỗi tải đơn hàng');

                const tbody = document.querySelector('#ordersTable tbody');
                const empty = document.getElementById('emptyState');
                tbody.innerHTML = '';

                if (json.data.length === 0) {
                    empty.classList.remove('d-none');
                    return;
                }
                empty.classList.add('d-none');

                json.data.forEach(order => {
                    const total = Number(order.total_amount).toLocaleString('vi-VN') + '₫';
                    const date = new Date(order.created_at).toLocaleDateString('vi-VN');

                    const statusInfo = {
                        pending: {
                            text: 'Chờ xử lý',
                            class: 'status-pending'
                        },
                        processing: {
                            text: 'Đang xử lý',
                            class: 'status-processing'
                        },
                        shipped: {
                            text: 'Đã giao',
                            class: 'status-shipped'
                        },
                        delivered: {
                            text: 'Hoàn thành',
                            class: 'status-delivered'
                        },
                        cancelled: {
                            text: 'Đã hủy',
                            class: 'status-cancelled'
                        }
                    };
                    const s = statusInfo[order.status] || statusInfo.pending;

                    tbody.innerHTML += `
                <tr>
                    <td class="text-center fw-bold text-primary">#${order.order_id}</td>
                    <td class="text-end text-danger fw-bold">${total}</td>
                    <td class="text-center">${date}</td>
                    <td class="text-center">
                        <span class="badge ${s.class} px-3 py-2">${s.text}</span>
                        <select class="form-select form-select-sm mt-2 statusSelect" data-id="${order.order_id}">
                            <option value="pending"     ${order.status==='pending'?'selected':''}>Chờ xử lý</option>
                            <option value="processing"  ${order.status==='processing'?'selected':''}>Đang xử lý</option>
                            <option value="shipped"     ${order.status==='shipped'?'selected':''}>Đã giao</option>
                            <option value="delivered"   ${order.status==='delivered'?'selected':''}>Hoàn thành</option>
                            <option value="cancelled"   ${order.status==='cancelled'?'selected':''}>Đã hủy</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <button onclick="viewOrder(${order.order_id})" class="btn btn-info btn-sm">Chi tiết</button>
                    </td>
                </tr>`;
                });

                document.querySelectorAll('.statusSelect').forEach(sel => {
                    sel.onchange = () => updateStatus(sel.dataset.id, sel.value);
                });

            } catch (e) {
                alert('Lỗi load đơn hàng: ' + e.message);
            }
        }

        async function updateStatus(id, status) {
            await fetch(api + 'updateStatus.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    order_id: id,
                    status: status
                })
            });
            loadOrders();
        }

        function viewOrder(id) {
            window.location.href = `order-detail.php?id=${id}`;
        }

        loadOrders();
    </script>
</body>

</html>