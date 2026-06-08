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
    #prog-modal,#del-modal,#detail-drawer { transition:opacity .2s; }
    #prog-modal.hidden,#del-modal.hidden { display:none; }

    /* search */
    .search-wrap input {
        border:1px solid #e2e8f0; border-radius:10px;
        padding:7px 12px 7px 36px; font-size:13px;
        outline:none; width:100%; transition:border-color .15s;
    }
    .search-wrap input:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.12); }

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
        backdrop-filter:blur(2px); z-index:39;
        display:none;
    }
    #drawer-backdrop.open { display:block; }

    /* progress bar */
    .prog-track { background:#f1f5f9; border-radius:99px; height:6px; overflow:hidden; }
    .prog-fill  { height:6px; border-radius:99px; transition:width .6s cubic-bezier(.4,0,.2,1); }

    /* count-up */
    @keyframes countUp { from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none} }
    .count-anim { animation:countUp .4s ease both; }
</style>
