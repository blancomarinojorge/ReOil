@php
    $class = "hidden flex-col items-center gap-6 fixed left-1/2 bottom-10 py-5 px-8 bg-secondary-soft rounded-md border-[1px] translate-x-[-50%] max-w-xl sm:flex-row opacity-0 animate-show-popup ";
    $iconPath = '';
    $message = '';
    if (session('success')){
        $class.=" border-primary ";
        $iconPath = "resources/img/check-success.svg";
        $message = session('success');
    }elseif (session('error')){
        $class.=" border-error ";
        $iconPath = "resources/img/cross-error.svg";
        $message = session('error');
    }
@endphp

@if(session('success') || session('error'))
    <div id="info-message-popup" {{ $attributes->twMerge(['class' => $class]) }}>
        <img src="{{ Vite::asset($iconPath) }}" alt="icon" aria-disabled="true"/>
        <span>{{ $message }}</span>
    </div>

    <!--
        This is not a good practice, mainly because if we add more than one instace of this component the js will be loaded x times.
        I do it here anyway just because this will be called only once globally in the app.
    -->
    <script>
        /**
         * sets the display do flex to show the animation, then hides it again so is not in the document flow
         */
        document.addEventListener('DOMContentLoaded', ()=>{
            const popUp = document.getElementById('info-message-popup');
            popUp.classList.remove('hidden');
            popUp.classList.add('flex');
            setTimeout(()=>{
                popUp.classList.remove('flex');
                popUp.classList.add('hidden');
            }, 6000);
        });
    </script>
@endif

