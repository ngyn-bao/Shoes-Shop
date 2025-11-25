<?php
// contacts.php
$api = '/Shoes-Shop/api/Contact/';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý liên hệ - Shoes Shop Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .page-title { color: #2c3e50; font-weight: 600; margin-bottom: 1.5rem; }
        .table th, .table td { vertical-align: middle; }
        .col-id { width: 7%; text-align: center; }
        .col-name { width: 16%; }
        .col-email { width: 18%; }
        .col-phone { width: 12%; text-align: center; }
        .col-message { width: 28%; }
        .col-date { width: 12%; text-align: center; }
        .col-status { width: 10%; text-align: center; }
        .col-action { width: 9%; text-align: center; }
        .message-cell {
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 0; cursor: pointer;
        }
        .message-cell:hover {
            white-space: normal; overflow: visible; background: #fff3cd; padding: 10px; border-radius: 8px;
            max-width: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); position: relative; z-index: 10;
        }
        .empty-state { text-align: center; padding: 70px 20px; color: #6c757d; }
        .empty-state i { font-size: 4rem; opacity: 0.5; }
    </style>
</head>
<body class="p-4">
<div class="container-fluid">
    <h2 class="page-title mb-4">Quản lý liên hệ khách hàng</h2>
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="contactsTable">
                    <thead class="table-primary text-dark">
                        <tr>
                            <th class="col-id">ID</th>
                            <th class="col-name">Họ tên</th>
                            <th class="col-email">Email</th>
                            <th class="col-phone">Điện thoại</th>
                            <th class="col-message">Nội dung</th>
                            <th class="col-date">Ngày gửi</th>
                            <th class="col-status">Trạng thái</th>
                            <th class="col-action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="empty-state d-none" id="emptyState">
                    <i class="bi bi-inbox"></i>
                    <h4 class="mt-3">Chưa có liên hệ nào</h4>
                    <p>Khách hàng sẽ gửi tin nhắn qua form trên website.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const api = '<?= $api ?>';

async function loadContacts() {
    try {
        const res = await fetch(api + 'getAllContacts.php');
        if (!res.ok) throw new Error('Không kết nối được API');
        const json = await res.json();
        if (!json.success) throw new Error(json.message || 'Lỗi server');

        const tbody = document.querySelector('#contactsTable tbody');
        const empty = document.getElementById('emptyState');
        tbody.innerHTML = '';

        if (!json.data || json.data.length === 0) {
            empty.classList.remove('d-none');
            return;
        }
        empty.classList.add('d-none');

        json.data.forEach(c => {
            const date = new Date(c.created_at).toLocaleString('vi-VN', {
                day: '2-digit', month: '2-digit', year: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });

            const statusBadge = c.status === 'read'
                ? '<span class="badge bg-success">Đã đọc</span>'
                : '<span class="badge bg-warning text-dark">Chưa đọc</span>';

            tbody.innerHTML += `
                <tr>
                    <td class="text-center fw-bold">${c.contact_id}</td>
                    <td class="fw-medium">${escape(c.full_name)}</td>
                    <td>${escape(c.email)}</td>
                    <td class="text-center">${escape(c.phone)}</td>
                    <td class="message-cell" title="${escape(c.message)}">
                        ${escape(c.message.length > 80 ? c.message.substring(0,80) + '...' : c.message)}
                    </td>
                    <td class="text-center small text-muted">${date}</td>
                    <td class="text-center">
                        ${statusBadge}
                        <select class="form-select form-select-sm mt-1 statusSelect" data-id="${c.contact_id}">
                            <option value="pending" ${c.status==='pending'?'selected':''}>Chưa đọc</option>
                            <option value="read" ${c.status==='read'?'selected':''}>Đã đọc</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <button onclick="deleteContact(${c.contact_id})" class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>`;
        });

        document.querySelectorAll('.statusSelect').forEach(sel => {
            sel.onchange = () => updateStatus(sel.dataset.id, sel.value);
        });

    } catch (e) {
        alert('Lỗi load liên hệ: ' + e.message);
        console.error(e);
    }
}

async function deleteContact(id) {
    if (!confirm('Xóa vĩnh viễn liên hệ này?')) return;
    await fetch(api + 'deleteContact.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ contact_id: id })
    });
    loadContacts();
}

async function updateStatus(id, status) {
    await fetch(api + 'updateContactStatus.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ contact_id: id, status: status })
    });
}

function escape(text) {
    const div = document.createElement('div');
    div.textContent = text || '';
    return div.innerHTML;
}

loadContacts();
</script>
</body>
</html>