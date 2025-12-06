<?php
// products.php
$api = '../api/Product/';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm - Shoes Shop Admin</title>
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

        .table img {
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .price-original {
            text-decoration: line-through;
            color: #95a5a6;
            font-size: 0.9em;
        }

        .price-sale {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.1em;
        }

        .btn-action {
            font-size: 0.85rem;
            padding: 0.35rem 0.75rem;
        }

        .modal-header {
            background: #3498db;
            color: white;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
        }
    </style>
</head>

<body class="p-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">Quản lý sản phẩm</h2>
            <button id="addProductBtn" class="btn btn-success btn-lg shadow-sm d-flex align-items-center gap-2">
                Thêm sản phẩm mới
            </button>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="productsTable">
                        <thead class="table-primary text-dark">
                            <tr>
                                <th class="text-center" width="60">ID</th>
                                <th>Tên sản phẩm</th>
                                <th width="150" class="text-center">Giá bán</th>
                                <th width="100" class="text-center">Tồn kho</th>
                                <th width="120" class="text-center">Ảnh chính</th>
                                <th width="150" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content overflow-hidden">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitle">Thêm sản phẩm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <form id="productForm">
                        <input type="hidden" id="product_id">
                        <div class="row g-3 mb-3">
                            <div class="col-lg-7">
                                <label class="form-label required">Tên sản phẩm</label>
                                <input type="text" class="form-control form-control-lg" id="product_name" required>
                            </div>
                            <div class="col-lg-5">
                                <label class="form-label required">Giá gốc (₫)</label>
                                <input type="number" class="form-control form-control-lg" id="original_price" min="1000" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label required">Danh mục</label>
                                <select class="form-select" id="category_id" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    <option value="1">Giày Nam</option>
                                    <option value="2">Giày Nữ</option>
                                    <option value="3">Giày Trẻ em</option>
                                    <option value="4">Phụ kiện</option>
                                    <option value="5">Dép / Sandal</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label required">Thương hiệu</label>
                                <select class="form-select" id="brand_id" required>
                                    <option value="">-- Chọn thương hiệu --</option>
                                    <option value="1">Nike</option>
                                    <option value="2">Adidas</option>
                                    <option value="3">Puma</option>
                                    <option value="4">Vans</option>
                                    <option value="5">Converse</option>
                                    <option value="6">New Balance</option>
                                    <option value="7">Jordan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-danger">Giá khuyến mãi (₫)</label>
                                <input type="number" class="form-control" id="sale_price" value="0" min="0">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Số lượng tồn kho</label>
                                <input type="number" class="form-control" id="stock" value="100" min="0">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Link ảnh chính (URL)</label>
                                <input type="url" class="form-control" id="image_url">
                                <small class="text-muted">Dán link từ Imgur, Cloudinary...</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả sản phẩm</label>
                            <textarea class="form-control" id="description" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary btn-lg px-5" id="saveProduct">Lưu sản phẩm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const api = '<?= $api ?>';

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
                    <td class="text-center">${sale ? `<del>${og}₫</del><br><strong class="text-danger">${sale}₫</strong>` : og + '₫'}</td>
                    <td class="text-center">${p.stock || 0}</td>
                    <td>${p.image_url ? `<img src="${p.image_url}" width="80" class="rounded shadow">` : 'Chưa có'}</td>
                    <td class="text-center">
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
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    product_id: id
                })
            });
            loadProducts();
        }

        async function editProduct(id) {
            const res = await fetch(api + 'getProductById.php?id=' + id);
            const json = await res.json();
            if (!json.success || !json.data) return alert('Không tìm thấy');

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

            if (!formData.product_name || formData.price <= 0 || formData.category_id === 0 || formData.brand_id === 0) {
                alert('Vui lòng nhập đầy đủ: Tên, Giá gốc, Danh mục, Thương hiệu!');
                return;
            }

            if (id) formData.product_id = parseInt(id);
            const url = id ? 'updateProduct.php' : 'createProduct.php';

            const res = await fetch(api + url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
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

        loadProducts();
    </script>
</body>

</html>