<script>
let usersFromDB = @json($users->items());

// ── Modal handlers ──
function openCreateModal() {
    document.getElementById('modal-title').textContent = 'Tambah Pengguna Baru';
    document.getElementById('edit-id').value = '';
    document.getElementById('form-method-edit').style.display = 'none';
    document.getElementById('user-form').action = '{{ route("pengguna.store") }}';
    document.getElementById('f-nama').value = '';
    document.getElementById('f-username').value = '';
    document.getElementById('f-email').value = '';
    document.getElementById('f-role').value = 'Operator';
    document.getElementById('f-password').value = '';
    document.getElementById('f-password').required = true;
    document.getElementById('pwd-hint').style.display = 'none';
    document.querySelector('input[name="status"][value="Aktif"]').checked = true;
    document.getElementById('form-error').classList.add('hidden');
    document.getElementById('user-modal').classList.remove('modal-closed');
    document.body.style.overflow = 'hidden';
}

function openEditModal(id) {
    const btn = document.querySelector(`button[data-user][onclick*="${id}"]`);
    const user = JSON.parse(btn.dataset.user);

    document.getElementById('modal-title').textContent = 'Edit Pengguna';
    document.getElementById('edit-id').value = user.id;
    document.getElementById('form-method-edit').style.display = '';
    document.getElementById('user-form').action = '/pengguna/' + user.id;
    document.getElementById('f-nama').value = user.name;
    document.getElementById('f-username').value = user.username;
    document.getElementById('f-email').value = user.email;
    document.getElementById('f-role').value = user.role;
    document.getElementById('f-password').value = '';
    document.getElementById('f-password').required = false;
    document.getElementById('pwd-hint').style.display = '';
    document.querySelector(`input[name="status"][value="${user.status}"]`).checked = true;
    document.getElementById('form-error').classList.add('hidden');
    document.getElementById('user-modal').classList.remove('modal-closed');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('user-modal').classList.add('modal-closed');
    document.body.style.overflow = '';
}

// ── Reset Password ──
function openResetModal(id) {
    const user = usersFromDB.find(u => u.id === id);
    if (!user) return;
    document.getElementById('reset-name').textContent = `Reset password untuk: ${user.name}`;
    document.getElementById('reset-form').action = `/pengguna/${user.id}/reset-password`;
    document.getElementById('reset-modal').classList.remove('modal-closed');
    document.body.style.overflow = 'hidden';
}

function closeResetModal() {
    document.getElementById('reset-modal').classList.add('modal-closed');
    document.body.style.overflow = '';
}

// ── Audit Log (placeholder, no audit log table yet) ──
function renderAuditLog() {
    const container = document.getElementById('audit-log-container');
    container.innerHTML = `<div class="text-center py-10"><p class="text-sm text-slate-400">Belum ada aktivitas</p></div>`;
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeModal(); closeResetModal(); }
});

renderAuditLog();
</script>
