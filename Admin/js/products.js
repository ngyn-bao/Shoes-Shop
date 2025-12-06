// js/products.js – BẢN HOÀN CHỈNH CUỐI CÙNG – ĐÃ CHẠY NGON LÀNH
const api = '/Shoes-Shop/api/Product/';

async function loadProducts() {
    try {
        const res = await fetch(api + 'getAllProducts.php');
        const json = await res.json();
        if (!json.success) throw new Error(json.message || 'Load thất bại');

        const tbody = document.querySelector('#productsTable tbody');
        tbody.innerHTML = '';

        json.data.forEach(p => {
            const og = Number(p.price).toLocaleString('vi-VN');
            const sale = p.discount > 0 ? Number(p.discount).toLocaleString('vi-VN') : null;

            tbody.innerHTML += `
                <tr>
                    <td>${p.product_id}</td>
                    <td>${p.product_name}</td>
                    <td>${sale ? `<del>${og}₫</del><br><strong class="text-danger">${sale}₫</strong>` : og + '₫'}</td>
                    <td class="text-center">${p.stock || 0}</td>
                    <td>${p.image_url ? `<img src="${p.image_url}" width="80" class="rounded shadow">` : 'Chưa có'}</td>
                    <td>
                        <button onclick="editProduct(${p.product_id})" class="btn btn-sm btn-warning">Sửa</button>
                        <button onclick="deleteProduct(${p.product_id})" class="btn btn-sm btn-danger">Xóa</button>
                    </td>
                </tr>`;
        });
    } catch (e) {
        alert('Lỗi load: ' + e.message);
    }
}

async function deleteProduct(id) {
    if (!confirm('Xóa thật nhé?')) return;
    await fetch(api + 'deleteProduct.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: id })
    });
    loadProducts();
}

async function editProduct(id) {
    const res = await fetch(api + 'getProductById.php?id=' + id);
    const json = await res.json();
    if (!json.success || !json.data) return alert('Không tìm thấy sản phẩm');

    const p = json.data;
    document.getElementById('product_id').value = p.product_id;
    document.getElementById('product_name').value = p.product_name;
    document.getElementById('category_id').value = p.category_id || '';
    document.getElementById('brand_id').value = p.brand_id || '';
    document.getElementById('original_price').value = p.price;
    document.getElementById('sale_price').value = p.discount || 0;
    document.getElementById('stock').value = p.stock || 0;
    document.getElementById('description').value = p.description || '';
    document.getElementById('image_url').value = p.image_main || '';

    document.getElementById('modalTitle').innerText = 'Sửa sản phẩm';
    new bootstrap.Modal('#productModal').show();
}

document.getElementById('addProductBtn').addEventListener('click', () => {
    document.getElementById('productForm')?.reset();
    document.getElementById('product_id').value = '';
    document.getElementById('modalTitle').innerText = 'Thêm sản phẩm mới';
    new bootstrap.Modal('#productModal').show();
});

// ==================== LƯU SẢN PHẨM – QUAN TRỌNG NHẤT ====================
document.getElementById('saveProduct').addEventListener('click', async () => {
    const id = document.getElementById('product_id').value.trim();

    const formData = {
        product_name: document.getElementById('product_name').value.trim(),
        category_id: parseInt(document.getElementById('category_id').value) || 0,
        brand_id: parseInt(document.getElementById('brand_id').value) || 0,
        price: parseFloat(document.getElementById('original_price').value) || 0,
        discount: parseFloat(document.getElementById('sale_price').value) || 0,
        stock: parseInt(document.getElementById('stock').value) || 0,
        description: document.getElementById('description').value.trim(),
        image_url: document.getElementById('image_url').value.trim() || null
    };

    // Bắt buộc nhập
    if (!formData.product_name || formData.price <= 0 || formData.category_id === 0 || formData.brand_id === 0) {
        alert('Vui lòng nhập đầy đủ: Tên, Giá gốc, Danh mục, Thương hiệu!');
        return;
    }

    if (id) formData.product_id = parseInt(id);

    const url = id ? 'updateProduct.php' : 'createProduct.php';

    const res = await fetch(api + url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
    });

    const result = await res.json();

    if (result.success) {
        alert(id ? 'Cập nhật thành công!' : 'Thêm sản phẩm thành công!');
        bootstrap.Modal.getInstance('#productModal').hide();
        loadProducts();
    } else {
        alert('Lỗi: ' + result.message);
    }
});

// Load ngay khi mở trang
loadProducts();