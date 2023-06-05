@props(['rate'])

<div class="flex gap-1 mb-4 items-center">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $rate)
            <i class="fa-solid fa-star text-yellow-500"></i>
        @else
            <i class="fa-regular fa-star text-yellow-500"></i>
        @endif
    @endfor
</div>
