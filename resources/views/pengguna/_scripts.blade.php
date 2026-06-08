<script>
let usersFromDB = @json($users->items());
let auditLogs = [
    { id: 1, user: '{{ auth()->user()->name }}', action: 'mengakses halaman manajemen pengguna', target: '-', time: 'Baru saja', color: 'bg-sky-500' },
];

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
    document.getElementById('user-modal').classList.remove('hidden');
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
    document.getElementById('user-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('user-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

// ── Reset Password ──
function openResetModal(id) {
    const user = usersFromDB.find(u => u.id === id);
    if (!user) return;
    document.getElementById('reset-name').textContent = `Reset password untuk: ${user.name}`;
    document.getElementById('reset-form').action = `/pengguna/${user.id}/reset-password`;
    document.getElementById('reset-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeResetModal() {
    document.getElementById('reset-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

// ── Audit Log (client-side, since we don't have audit log table) ──
function renderAuditLog() {
    const container = document.getElementById('audit-log-container');
    if (!auditLogs.length) {
        container.innerHTML = `<div class="text-center py-10"><p class="text-sm text-slate-400">Belum ada aktivitas</p></div>`;
        return;
    }
    container.innerHTML = auditLogs.map((log, index) => `
        <div class="flex gap-4 group">
            <div class="flex flex-col items-center pt-1.5">
                <div class="w-2.5 h-2.5 rounded-full ${log.color} ring-4 ring-white shadow-sm flex-shrink-0 z-10"></div>
                ${index !== auditLogs.length - 1 ? '<div class="w-px h-full bg-slate-100 mt-1"></div>' : ''}
            </div>
            <div class="pb-6">
                <p class="text-xs text-slate-600 leading-relaxed">
                    <span class="font-bold text-slate-800">${log.user}</span>
                    ${log.action}
                    <span class="font-medium text-slate-700">${log.target}</span>
                </p>
                <p class="text-[10px] text-slate-400 mt-1 flex items-center gap-1">
                    <x-icon name="clock" class="w-3 h-3" />
                    ${log.time}
                </p>
            </div>
        </div>
    `).join('');
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeModal(); closeResetModal(); }
});

renderAuditLog();
</script>
