@once
<style>
    .auth-burger-toggle {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        background: #fff;
        cursor: pointer;
        transition: background-color 0.15s ease, border-color 0.15s ease;
    }
    .auth-burger-toggle:hover,
    .auth-burger-toggle:focus-visible {
        background: #f9fafb;
        border-color: #d1d5db;
        outline: none;
    }
    .auth-burger-toggle .auth-burger-bar {
        position: absolute;
        left: 0.55rem;
        right: 0.55rem;
        height: 2px;
        border-radius: 1px;
        background: #111827;
        transition: transform 0.25s ease, opacity 0.2s ease, top 0.25s ease, bottom 0.25s ease;
    }
    .auth-burger-toggle .auth-burger-top { top: 0.9rem; }
    .auth-burger-toggle .auth-burger-mid { top: 50%; transform: translateY(-50%); }
    .auth-burger-toggle .auth-burger-bot { bottom: 0.9rem; }

    .auth-burger-toggle.is-open .auth-burger-top {
        top: 50%;
        transform: translateY(-50%) rotate(45deg);
    }
    .auth-burger-toggle.is-open .auth-burger-mid {
        opacity: 0;
        transform: translateY(-50%) scaleX(0);
    }
    .auth-burger-toggle.is-open .auth-burger-bot {
        bottom: auto;
        top: 50%;
        transform: translateY(-50%) rotate(-45deg);
    }
    @media (hover: hover) and (pointer: fine) {
        .auth-burger-toggle:hover .auth-burger-top {
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }
        .auth-burger-toggle:hover .auth-burger-mid {
            opacity: 0;
            transform: translateY(-50%) scaleX(0);
        }
        .auth-burger-toggle:hover .auth-burger-bot {
            bottom: auto;
            top: 50%;
            transform: translateY(-50%) rotate(-45deg);
        }
    }
</style>
@endonce
