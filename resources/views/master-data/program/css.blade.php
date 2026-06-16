<style>
    /* Tree lines */
    .tree-child { position:relative; padding-left:20px; }
    .tree-child::before { content:''; position:absolute; left:6px; top:0; bottom:0; border-left:1.5px dashed #cbd5e1; }
    .tree-child::after  { content:''; position:absolute; left:6px; top:18px; width:12px; height:1.5px; background:#cbd5e1; }
    .tree-child:last-child::before { height:18px; }

    /* badges */
    .badge-aktif    { background:#d1fae5; color:#065f46; }
    .badge-nonaktif { background:#f1f5f9; color:#64748b; }

    /* row hover */
    .trow { transition:background .12s; }
    .trow:hover { background:#f8fafc; }

    /* modals */
    #prog-modal { transition:opacity .25s ease, visibility .25s ease; }
    #prog-modal.modal-closed { opacity:0; visibility:hidden; pointer-events:none; }
    #prog-modal:not(.modal-closed) { opacity:1; visibility:visible; pointer-events:all; }
    #prog-modal > div:first-child { transition: opacity .25s ease; }
    #prog-modal.modal-closed > div:first-child { opacity: 0; }
    #prog-modal > .modal-panel {
        transform: scale(0.92) translateY(12px);
        transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    #prog-modal:not(.modal-closed) > .modal-panel {
        transform: scale(1) translateY(0);
    }
    #del-modal { transition: opacity .25s ease, visibility .25s ease; }
    #del-modal.modal-closed { opacity:0; visibility:hidden; pointer-events:none; }
    #del-modal:not(.modal-closed) { opacity:1; visibility:visible; pointer-events:all; }
    #del-modal > div:first-child { transition: opacity .25s ease; }
    #del-modal.modal-closed > div:first-child { opacity: 0; }
    #del-modal > .modal-panel {
        transform: scale(0.92) translateY(12px);
        transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    #del-modal:not(.modal-closed) > .modal-panel { transform: scale(1) translateY(0); }

    /* simple select */
    select.simple-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        padding-right: 32px;
        border-radius: 10px;
        font-size: 13px;
        line-height: normal;
        cursor: pointer;
    }
    select.simple-select:hover {
        border-color: #94a3b8;
    }

    /* detail drawer */
    #detail-drawer {
        position:fixed; top:0; right:0; bottom:0; width:380px;
        background:#fff; box-shadow:-8px 0 32px rgba(15,23,42,.1);
        z-index:40; transform:translateX(100%);
        transition:transform .25s cubic-bezier(.4,0,.2,1);
        overflow-y:auto;
    }
    #detail-drawer.open { transform:translateX(0); }
    #drawer-backdrop {
        position:fixed; inset:0; background:rgba(15,23,42,.35);
        z-index:39; opacity:0; visibility:hidden;
        transition: opacity .25s ease, visibility .25s ease;
    }
    #drawer-backdrop.open { opacity:1; visibility:visible; }

    /* progress bar */
    .prog-track { background:#f1f5f9; border-radius:99px; height:6px; overflow:hidden; }
    .prog-fill  { height:6px; border-radius:99px; transition:width .6s cubic-bezier(.4,0,.2,1); }

    /* count-up */
    @keyframes countUp { from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none} }
    .count-anim { animation:countUp .4s ease both; }
</style>
