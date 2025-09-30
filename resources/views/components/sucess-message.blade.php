<div id="toast-success" role="alert">
    <div class="toast-icon">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
        </svg>
    </div>
    <div class="toast-text">{{ session('success') }}</div>
    <button aria-label="Close" onclick="this.parentElement.remove()">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>

<style>
    #toast-success {
        position: fixed;
        bottom: 1rem;
        right: -5rem;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 20rem;
        padding: 1rem;
        background-color: #166534;
        color: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 50;
        opacity: 0;
        pointer-events: auto;
        animation: fadein 0.5s forwards;
    }

    #toast-success .toast-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 2rem;
        height: 2rem;
        color: #16a34a;
        background-color: #dcfce7;
        border-radius: 0.5rem;
    }

    #toast-success .toast-text {
        margin-left: 0.75rem;
        font-size: 0.875rem;
        flex: 1;
    }

    #toast-success button {
        margin-left: auto;
        margin-right: -0.375rem;
        margin-top: -0.375rem;
        background-color: #166534;
        color: white;
        border-radius: 0.5rem;
        padding: 0.375rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 2rem;
        width: 2rem;
        border: none;
        cursor: pointer;
    }

    @keyframes fadein {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(1rem);
        }

        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }

    @keyframes fadeout {
        from {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        to {
            opacity: 0;
            transform: translateX(-50%) translateY(1rem);
        }
    }
</style>

<script>
    const toast = document.getElementById('toast-success');
    setTimeout(() => {
        toast.style.animation = 'fadeout 0.5s forwards';
        setTimeout(() => toast.remove(), 500);
    }, 5000);
</script>