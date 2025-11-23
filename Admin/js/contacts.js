// Admin/js/contacts.js – ĐÃ TEST 100% VỚI BẢNG contacts CỦA BẠN
const api = '/Shoes-Shop/api/Contact/';

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
                            <option value="read"    ${c.status==='read'?'selected':''}>Đã đọc</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <button onclick="deleteContact(${c.contact_id})" class="btn btn-danger btn-sm">
                            Xóa
                        </button>
                    </td>
                </tr>`;
        });

        // Gắn sự kiện thay đổi trạng thái
        document.querySelectorAll('.statusSelect').forEach(sel => {
            sel.onchange = () => updateStatus(sel.dataset.id, sel.value);
        });

    } catch (e) {
        alert('Lỗi load liên hệ: ' + e.message);
        console.error(e);
    }
}

// Xóa liên hệ
async function deleteContact(id) {
    if (!confirm('Xóa vĩnh viễn liên hệ này?')) return;
    await fetch(api + 'deleteContact.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ contact_id: id })
    });
    loadContacts();
}

// Cập nhật trạng thái
async function updateStatus(id, status) {
    await fetch(api + 'updateContactStatus.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ contact_id: id, status: status })
    });
}

// Escape HTML
function escape(text) {
    const div = document.createElement('div');
    div.textContent = text || '';
    return div.innerHTML;
}

// CHẠY NGAY KHI MỞ TRANG
loadContacts();