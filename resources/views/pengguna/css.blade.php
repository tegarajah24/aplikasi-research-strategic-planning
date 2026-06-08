<style>
    #user-modal, #del-modal, #reset-modal { transition: opacity .25s ease, visibility .25s ease; }
    #user-modal.modal-closed, #del-modal.modal-closed, #reset-modal.modal-closed {
        opacity: 0; visibility: hidden; pointer-events: none;
    }
    #user-modal:not(.modal-closed), #del-modal:not(.modal-closed), #reset-modal:not(.modal-closed) {
        opacity: 1; visibility: visible; pointer-events: all;
    }
    #user-modal > .modal-panel, #del-modal > .modal-panel, #reset-modal > .modal-panel {
        transform: scale(0.92) translateY(12px);
        transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    #user-modal:not(.modal-closed) > .modal-panel,
    #del-modal:not(.modal-closed) > .modal-panel,
    #reset-modal:not(.modal-closed) > .modal-panel {
        transform: scale(1) translateY(0);
    }
    .badge-aktif { background:#d1fae5; color:#059669; border:1px solid #a7f3d0; }
    .badge-nonaktif { background:#fee2e2; color:#dc2626; border:1px solid #fecaca; }
    .role-admin { background:#eff6ff; color:#2563eb; border:1px solid #bfdbfe; }
    .role-operator { background:#f5f3ff; color:#7c3aed; border:1px solid #ddd6fe; }
    .role-viewer { background:#fffbeb; color:#d97706; border:1px solid #fde68a; }
    .search-wrap input { border:1px solid #e2e8f0; border-radius:10px; padding:7px 12px 7px 36px; font-size:13px; outline:none; width:100%; transition:border-color .15s; }
    .search-wrap input:focus { border-color:#0ea5e9; box-shadow:0 0 0 3px rgba(14,165,233,.12); }
</style>
