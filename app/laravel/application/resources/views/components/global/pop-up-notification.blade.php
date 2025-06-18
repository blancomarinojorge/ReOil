@php
    $initialMessage = session('success') ?? session('error') ?? '';
    $initialIsError = session('error') ? true : false;

    $baseClass = "hidden flex-col items-center gap-6 fixed left-1/2 bottom-10 py-5 px-8 bg-secondary-soft rounded-md border-[1px] translate-x-[-50%] max-w-xl sm:flex-row opacity-0 animate-show-popup";
@endphp

<div id="info-message-popup" class="{{ $baseClass }} {{ $initialIsError ? 'border-error' : 'border-primary' }}" aria-live="polite" role="alert" style="opacity: 0;">
    <img id="info-message-icon" src="{{ Vite::asset($initialIsError ? 'resources/img/cross-error.svg' : 'resources/img/check-success.svg') }}" alt="icon" aria-hidden="true" />
    <span id="info-message-text">{{ $initialMessage }}</span>
</div>

<script>
    (function(){
        const popup = document.getElementById('info-message-popup');
        const icon = document.getElementById('info-message-icon');
        const text = document.getElementById('info-message-text');
        let hideTimeout;

        function showPopup(message, isError = false) {
            clearTimeout(hideTimeout);

            // Update styles
            popup.classList.remove('hidden');
            popup.style.opacity = 1;
            popup.classList.add('flex');

            // Border color
            popup.classList.toggle('border-error', isError);
            popup.classList.toggle('border-primary', !isError);

            // Icon and alt
            icon.src = isError
                ? "{{ Vite::asset('resources/img/cross-error.svg') }}"
                : "{{ Vite::asset('resources/img/check-success.svg') }}";
            icon.alt = isError ? "Error icon" : "Success icon";

            // Text
            text.textContent = message;

            // Animate popup (you can tweak this if needed)
            popup.classList.add('animate-show-popup');

            // Auto hide after 6s
            hideTimeout = setTimeout(() => {
                popup.classList.remove('flex');
                popup.style.opacity = 0;
                popup.classList.add('hidden');
                popup.classList.remove('animate-show-popup');
            }, 6000);
        }

        // Show popup on initial load if session message exists
        @if($initialMessage)
        document.addEventListener('DOMContentLoaded', () => {
            showPopup(@json($initialMessage), @json($initialIsError));
        });
        @endif

        // Expose function globally
        window.showPopUpNotification = showPopup;

        // Prevent popup showing again on bfcache back navigation, TODO not working
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                popup.classList.remove('flex');
                popup.style.opacity = 0;
                popup.classList.add('hidden');
            }
        });
    })();
</script>
