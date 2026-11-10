
<style>
    .rec-id {
        color: #4361ee;
    }

    .rec-banner {
        background: #e8eefc;
        border-radius: 8px;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .rec-code {
        font-size: 22px;
        font-weight: 600;
        color: #4361ee;
        margin-right: 10px;
    }

    .rec-badge {
        display: inline-block;
        border: 1px solid #4361ee;
        color: #4361ee;
        border-radius: 4px;
        padding: 1px 8px;
        font-size: 12px;
        background: #fff;
    }

    .rec-raised {
        color: #7a7f9a;
        font-size: 14px;
    }

    .rec-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 20px;
    }

    .rec-card {
        border: 1px solid #e5e7ef;
        border-radius: 8px;
        padding: 18px 20px;
        margin-top: 20px;
    }

    .rec-grid .rec-card {
        margin-top: 0;
    }

    .rec-card h6 {
        font-size: 12px;
        letter-spacing: .6px;
        text-transform: uppercase;
        color: #7a7f9a;
        margin: 0 0 12px;
        font-weight: 600;
    }

    .rec-row {
        display: flex;
        gap: 16px;
        padding: 4px 0;
        font-size: 14px;
    }

    .rec-label {
        width: 110px;
        flex: none;
        color: #7a7f9a;
    }

    .rec-value {
        word-break: break-word;
    }

    .rec-link {
        color: #4361ee;
    }

    .rec-text {
        font-size: 14px;
        white-space: pre-line;
        word-break: break-word;
    }

    .rec-muted {
        color: #7a7f9a;
        font-size: 14px;
    }

    .rec-files {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 12px;
    }

    .rec-files img {
        width: 100%;
        height: 130px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e5e7ef;
        display: block;
    }

    .rec-files video {
        width: 100%;
        max-height: 220px;
        border-radius: 6px;
        background: #000;
        display: block;
    }

    .rec-tl-item {
        display: flex;
        gap: 12px;
        padding: 6px 0;
        font-size: 13px;
    }

    .rec-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #4361ee;
        margin-top: 6px;
        flex: none;
    }

    .rec-tl-meta {
        color: #7a7f9a;
        margin-left: 6px;
    }

    .rec-tl-remarks {
        margin-top: 4px;
        font-size: 13px;
        white-space: pre-line;
    }

    @media (max-width: 800px) {
        .rec-grid {
            grid-template-columns: 1fr;
        }
    }

    .dark .rec-banner {
        background: #1b2e4b;
    }

    .dark .rec-card {
        border-color: #253b5c;
    }
</style>
