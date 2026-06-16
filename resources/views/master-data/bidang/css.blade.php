<style>
    /* ── Hierarchy tree lines ── */
    .tree-item { position: relative; padding-left: 20px; }
    .tree-item::before {
        content: '';
        position: absolute;
        left: 6px; top: 0; bottom: 0;
        border-left: 1.5px dashed #cbd5e1;
    }
    .tree-item::after {
        content: '';
        position: absolute;
        left: 6px; top: 18px;
        width: 12px; height: 1.5px;
        background: #cbd5e1;
    }
    .tree-item:last-child::before { height: 18px; }

    /* ── Badge status ── */
    .badge-active   { background:#d1fae5; color:#065f46; }
    .badge-inactive { background:#f1f5f9; color:#64748b; }

    /* ── Expand accordion ── */
    .hier-body { overflow: hidden; transition: max-height .25s ease; }

    /* ── Modal ── */
    #bidang-modal { transition: opacity .25s ease, visibility .25s ease; }
    #bidang-modal.modal-closed {
        opacity: 0; visibility: hidden; pointer-events: none;
    }
    #bidang-modal:not(.modal-closed) {
        opacity: 1; visibility: visible; pointer-events: all;
    }
    #bidang-modal > div:first-child { transition: opacity .25s ease; }
    #bidang-modal.modal-closed > div:first-child { opacity: 0; }
    #bidang-modal > .modal-panel {
        transform: scale(0.92) translateY(12px);
        transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    #bidang-modal:not(.modal-closed) > .modal-panel {
        transform: scale(1) translateY(0);
    }

    /* ── Table row hover ── */
    .trow { transition: background .12s; }
    .trow:hover { background: #f8fafc; }

    /* ── Search input ── */
    .search-wrap input {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 7px 12px 7px 36px;
        font-size: 13px;
        outline: none;
        width: 176px;
        transition: border-color .15s;
    }
    .search-wrap input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }

    /* ── Delete Modal ── */
    #del-modal { transition: opacity .25s ease, visibility .25s ease; }
    #del-modal.modal-closed {
        opacity: 0; visibility: hidden; pointer-events: none;
    }
    #del-modal:not(.modal-closed) {
        opacity: 1; visibility: visible; pointer-events: all;
    }
    #del-modal > div:first-child { transition: opacity .25s ease; }
    #del-modal.modal-closed > div:first-child { opacity: 0; }
    #del-modal > .modal-panel {
        transform: scale(0.92) translateY(12px);
        transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    #del-modal:not(.modal-closed) > .modal-panel {
        transform: scale(1) translateY(0);
    }

    /* ── Animated count ── */
    @keyframes countUp { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }
    .count-anim { animation: countUp .4s ease both; }
</style>
