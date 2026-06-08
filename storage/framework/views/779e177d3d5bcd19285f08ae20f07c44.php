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
    #bidang-modal { transition: opacity .2s; }
    #bidang-modal.hidden { display: none; }

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
        width: 100%;
        transition: border-color .15s;
    }
    .search-wrap input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }

    /* ── Animated count ── */
    @keyframes countUp { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }
    .count-anim { animation: countUp .4s ease both; }
</style>
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views\master-data\bidang\css.blade.php ENDPATH**/ ?>