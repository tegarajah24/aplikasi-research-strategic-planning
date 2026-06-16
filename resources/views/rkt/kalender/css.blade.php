/* ── Custom Calendar Styles ── */
.cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); }
.cal-day  { min-height: 64px; display: flex; flex-direction: column; justify-content: space-between; }

.event-pill {
    font-size: 10px;
    line-height: 1.15;
    padding: 1px 4px;
    border-radius: 3px;
    cursor: pointer;
    transition: opacity .15s, transform .1s;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
    display: block;
}
.event-pill:hover { opacity: .85; transform: scale(1.02); }

/* status colours */
.ev-done       { background:#d1fae5; color:#065f46; border-left:3px solid #10b981; }
.ev-running    { background:#fef3c7; color:#92400e; border-left:3px solid #f59e0b; }
.ev-upcoming   { background:#dbeafe; color:#1e40af; border-left:3px solid #3b82f6; }
.ev-late       { background:#fee2e2; color:#991b1b; border-left:3px solid #ef4444; }

/* detail modal */
#ev-modal { transition: opacity .25s ease, visibility .25s ease; }
#ev-modal.modal-closed { opacity:0; visibility:hidden; pointer-events:none; }
#ev-modal:not(.modal-closed) { opacity:1; visibility:visible; pointer-events:all; }
#ev-modal > div:first-child { transition: opacity .25s ease; }
#ev-modal.modal-closed > div:first-child { opacity: 0; }
#ev-modal > .modal-panel {
    transform: scale(0.92) translateY(12px);
    transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
}
#ev-modal:not(.modal-closed) > .modal-panel { transform: scale(1) translateY(0); }

/* scrollbar hide on month body */
.cal-body::-webkit-scrollbar { display:none; }
.cal-body { -ms-overflow-style:none; scrollbar-width:none; }

/* today ring */
.today-cell .day-num {
    background: #2563eb;
    color: #fff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Upcoming list hover */
.upcoming-row { transition: background .15s; }
.upcoming-row:hover { background: #f8fafc; }

/* Simple select native styling */
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

/* Chip legend */
.legend-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    font-weight: 500;
    padding: 3px 10px;
    border-radius: 20px;
}
.chip-done    { background:#d1fae5; color:#065f46; }
.chip-running { background:#fef3c7; color:#92400e; }
.chip-upcoming{ background:#dbeafe; color:#1e40af; }
.chip-late    { background:#fee2e2; color:#991b1b; }
