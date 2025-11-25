// js/orders.js – ĐÃ BỎ CỘT KHÁCH HÀNG – SIÊU GỌN, SIÊU NHANH
const api = '/Shoes-Shop/api/Order/';

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
                pending:     { text: 'Chờ xử lý',    class: 'status-pending' },
                processing:  { text: 'Đang xử lý',   class: 'status-processing' },
                shipped:     { text: 'Đã giao',      class: 'status-shipped' },
                delivered:   { text: 'Hoàn thành',   class: 'status-delivered' },
                cancelled:   { text: 'Đã hủy',       class: 'status-cancelled' }
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
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ order_id: id, status: status })
    });
    loadOrders(); // reload để thấy thay đổi ngay
}

function viewOrder(id) {
    window.location.href = `order-detail.html?id=${id}`;
}

loadOrders(); // chạy ngay khi mở trang