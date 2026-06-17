<script>
// ── Modal handlers ──
function openCreateModal() {
    document.getElementById('modal-title').textContent = 'Tambah Pengguna Baru';
    document.getElementById('edit-id').value = '';
    document.getElementById('form-method-edit').style.display = 'none';
    document.getElementById('form-method-input').disabled = true;
    document.getElementById('user-form').action = '{{ route("pengguna.store") }}';
    document.getElementById('f-nama').value = '';
    document.getElementById('f-username').value = '';
    document.getElementById('f-role').value = 'Admin';
    document.getElementById('f-password').value = '';
    document.getElementById('f-password').required = true;
    document.getElementById('pwd-hint').style.display = 'none';
    document.getElementById('form-error').classList.add('hidden');
    document.getElementById('prodi-field').classList.add('hidden');
    document.getElementById('f-prodi').value = '';
    document.getElementById('user-modal').classList.remove('modal-closed');
    document.body.style.overflow = 'hidden';
}

function openEditModal(id) {
    const btn = document.querySelector(`button[data-user][onclick*="${id}"]`);
    const user = JSON.parse(btn.dataset.user);

    document.getElementById('modal-title').textContent = 'Edit Pengguna';
    document.getElementById('edit-id').value = user.id;
    document.getElementById('form-method-edit').style.display = '';
    document.getElementById('form-method-input').disabled = false;
    document.getElementById('user-form').action = '/pengguna/' + user.id;
    document.getElementById('f-nama').value = user.name;
    document.getElementById('f-username').value = user.username;
    document.getElementById('f-role').value = user.role;
    document.getElementById('f-prodi').value = user.prodi_id || '';
    if (user.role === 'Kaprodi') {
        document.getElementById('prodi-field').classList.remove('hidden');
    } else {
        document.getElementById('prodi-field').classList.add('hidden');
    }
    document.getElementById('f-password').value = '';
    document.getElementById('f-password').required = false;
    document.getElementById('pwd-hint').style.display = '';
    document.getElementById('form-error').classList.add('hidden');
    document.getElementById('user-modal').classList.remove('modal-closed');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('user-modal').classList.add('modal-closed');
    document.body.style.overflow = '';
}

// ── View Detail ──
function openViewModal(id) {
    const btn = document.querySelector(`button[onclick*="openViewModal(${id})"]`);
    const user = JSON.parse(btn.dataset.user);

    document.getElementById('view-photo').src = user.profile_photo_url;
    document.getElementById('view-name').textContent = user.name;
    document.getElementById('view-username').textContent = `@${user.username}`;
    const roleEl = document.getElementById('view-role');
    roleEl.textContent = user.role;
    roleEl.className = `inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold role-${user.role.toLowerCase()}`;

    const statusEl = document.getElementById('view-status');
    const dot = document.createElement('span');
    dot.className = `w-1.5 h-1.5 rounded-full ${user.status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-500'}`;
    statusEl.innerHTML = '';
    statusEl.appendChild(dot);
    statusEl.appendChild(document.createTextNode(' ' + user.status));
    statusEl.className = `inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold ${user.status === 'Aktif' ? 'badge-aktif' : 'badge-nonaktif'}`;

    if (user.role === 'Kaprodi' && user.prodi) {
        document.getElementById('view-prodi').textContent = user.prodi.nama_prodi;
        document.getElementById('view-prodi-row').style.display = '';
        document.getElementById('view-prodi-divider').style.display = '';
    } else {
        document.getElementById('view-prodi-row').style.display = 'none';
        document.getElementById('view-prodi-divider').style.display = 'none';
    }

    document.getElementById('view-last-login').textContent = user.last_login_at
        ? new Date(user.last_login_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })
        : 'Belum pernah login';

    document.getElementById('view-created').textContent = new Date(user.created_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });

    document.getElementById('view-modal').classList.remove('modal-closed');
    document.body.style.overflow = 'hidden';
}

function closeViewModal() {
    document.getElementById('view-modal').classList.add('modal-closed');
    document.body.style.overflow = '';
}

function toggleProdiField() {
    const role = document.getElementById('f-role').value;
    const field = document.getElementById('prodi-field');
    if (role === 'Kaprodi') {
        field.classList.remove('hidden');
    } else {
        field.classList.add('hidden');
        document.getElementById('f-prodi').value = '';
    }
}

// ── Search / Filter ──
function filterTable() {
    const input = document.getElementById('search-input');
    const filter = input.value.toLowerCase().trim();
    const roleFilter = document.getElementById('filter-role').value;
    const tableBody = document.getElementById('table-body');
    const rows = tableBody.querySelectorAll('tr[data-search]');
    let visibleCount = 0;
    rows.forEach(row => {
        const text = row.getAttribute('data-search') || '';
        const role = row.getAttribute('data-role') || '';
        const matchesSearch = text.includes(filter);
        const matchesRole = !roleFilter || role === roleFilter;
        if (matchesSearch && matchesRole) {
            row.classList.remove('hidden');
            visibleCount++;
        } else {
            row.classList.add('hidden');
        }
    });
    document.getElementById('filter-empty-state').classList.toggle('hidden', visibleCount > 0);
    const dbEmpty = document.getElementById('filter-empty-state-db');
    if (dbEmpty) dbEmpty.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('search-input');
    const roleFilter = document.getElementById('filter-role');
    if (input) input.addEventListener('input', filterTable);
    if (roleFilter) roleFilter.addEventListener('change', filterTable);
});

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeModal(); closeViewModal(); }
});
</script>
