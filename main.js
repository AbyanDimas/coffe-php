// URL Backend diubah merujuk ke skrip api.php di dalam folder yang sama
const API_URL = 'api.php'; 

// Elemen DOM
const form = document.getElementById('menu-form');
const inputId = document.getElementById('menu-id');
const inputName = document.getElementById('name');
const inputCategory = document.getElementById('category');
const inputPrice = document.getElementById('price');
const formTitle = document.getElementById('form-title');
const btnSave = document.getElementById('btn-save');
const btnCancel = document.getElementById('btn-cancel');
const tbody = document.getElementById('menu-tbody');

// Fungsi untuk memformat mata uang (Rupiah)
const formatRupiah = (number) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
};

// Fungsi untuk mendapatkan class badge berdasarkan kategori
const getCategoryBadgeClass = (category) => {
    switch(category) {
        case 'Coffee': return 'badge-coffee';
        case 'Non-Coffee': return 'badge-non-coffee';
        case 'Snack': return 'badge-snack';
        default: return '';
    }
};

// 1. READ: Mengambil dan Menampilkan Data
async function fetchMenus() {
    try {
        const response = await fetch(API_URL);
        const text = await response.text();
        let menus;
        // Debugging apabila PHP menampilkan error bukan JSON
        try {
            menus = JSON.parse(text);
        } catch(e) {
            console.error("Server API PHP melempar respons aneh (bukan format JSON):", text);
            throw new Error('Respons bukan JSON yang valid');
        }
        
        tbody.innerHTML = ''; // Kosongkan tabel
        
        // Memeriksa kalau PHP membalikkan metadata {'error': ...}
        if (menus.error) {
            tbody.innerHTML = `<tr><td colspan="5" style="color: red; text-align: center;">${menus.error}</td></tr>`;
            return;
        }

        if (menus.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" class="loading-state">Belum ada data menu.</td></tr>`;
            return;
        }

        menus.forEach((menu, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${index + 1}</td>
                <td><strong>${menu.name}</strong></td>
                <td><span class="badge ${getCategoryBadgeClass(menu.category)}">${menu.category}</span></td>
                <td>${formatRupiah(menu.price)}</td>
                <td>
                    <button class="action-btn btn-edit" onclick="editMenu(${menu.id}, '${menu.name}', '${menu.category}', ${menu.price})">Edit</button>
                    <button class="action-btn btn-delete" onclick="deleteMenu(${menu.id})">Hapus</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    } catch (error) {
        console.error('Error fetching data:', error);
        tbody.innerHTML = `<tr><td colspan="5" style="color: red; text-align: center;">Gagal mengambil data dari API (api.php). Cek Log Console!</td></tr>`;
    }
}

// 2. CREATE & UPDATE: Menyimpan Data saat form disubmit
form.addEventListener('submit', async (e) => {
    e.preventDefault(); 
    
    // Ambil nilai dari form
    const id = inputId.value;
    const name = inputName.value;
    const category = inputCategory.value;
    const price = parseInt(inputPrice.value);
    
    const menuData = { name, category, price };

    try {
        if (id) {
            // mode UPDATE dengan parameter GET '?id=xxx' di belakang
            await fetch(`${API_URL}?id=${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(menuData)
            });
            alert('Menu berhasil diubah!');
        } else {
            // mode CREATE standard
            await fetch(API_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(menuData)
            });
            alert('Menu baru berhasil ditambahkan!');
        }
        
        resetForm();
        fetchMenus(); // Segarkan tampilan tabel
    } catch (error) {
        console.error('Error saving data:', error);
        alert('Terjadi kesalahan saat menyimpan data ke database PHP!');
    }
});

// Fungsi untuk mengisi form (menekan tombol Edit)
window.editMenu = (id, name, category, price) => {
    inputId.value = id;
    inputName.value = name;
    inputCategory.value = category;
    inputPrice.value = price;
    
    formTitle.textContent = 'Edit Menu (' + name + ')';
    btnSave.textContent = 'Simpan Perubahan';
    btnCancel.classList.remove('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

// Fungsi untuk mengembalikan tombol-tombol pada form 
const resetForm = () => {
    form.reset();
    inputId.value = '';
    formTitle.textContent = 'Tambah Menu Baru';
    btnSave.textContent = 'Simpan Menu';
    btnCancel.classList.add('hidden');
};

btnCancel.addEventListener('click', resetForm);

// 3. DELETE: Menghapus Data
window.deleteMenu = async (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus menu ini?')) {
        try {
            await fetch(`${API_URL}?id=${id}`, {
                method: 'DELETE'
            });
            alert('Menu berhasil dihapus!');
            fetchMenus(); 
        } catch (error) {
            console.error('Error deleting data:', error);
            alert('Gagal menghapus data!');
        }
    }
};

document.addEventListener('DOMContentLoaded', fetchMenus);
