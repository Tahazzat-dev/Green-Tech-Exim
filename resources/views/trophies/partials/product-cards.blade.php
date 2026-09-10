@foreach ($products as $product)
    @php
        $statusClasses = match ($product->status) {
            'in_stock' => 'text-green-700 bg-primary/20',
            'limited' => 'text-yellow-700 bg-yellow-100 dark:text-yellow-400 dark:bg-yellow-900/30',
            default => 'text-red-600 bg-red-100 dark:bg-red-900/30',
        };

        $statusLabel = match ($product->status) {
            'in_stock' => 'In Stock',
            'limited' => 'Limited',
            default => 'Stock Out',
        };
    @endphp

    @auth
        <a
            href="{{ route('trophies.show', [
                'category' => $product->category_id,
                'product' => $product->id
            ]) }}"
            class="relative flex flex-col items-center rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border"
        >
    @else
        <button
            type="button"
            @click="guestProductModalOpen = true"
            class="flex flex-col relative items-center rounded-lg shadow border bg-linear-to-br from-slate-50 to-slate-100/40 dark:from-slate-900/70 dark:to-slate-900 border-border text-left"
        >
    @endauth
        <img
            src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/trophy-small.jpeg') }}"
            alt="{{ $product->name }}"
            class="rounded-lg"
            referrerPolicy="no-referrer"
        />
        @if($product->is_top_product)
            <span class="absolute top-1.5 left-1.5 z-10 text-xs px-2 py-0.5 rounded bg-yellow-500 text-white shrink-0">
                Top
            </span>
        @endif
        <div class="w-full p-3 sm:p-4 flex flex-col gap-2">
            @auth
                <h3 class="w-full text-center text-sm sm:text-base font-bold text-text-body line-clamp-2">
                    {{ $product->name }}
                </h3>
            @else
                <h3 class="w-full text-center text-sm sm:text-base font-bold text-text-body">
                    Login to view price
                </h3>
            @endauth

            <span class="text-sm inline-block font-semibold py-1 px-3 text-center md:px-5 rounded-sm {{ $statusClasses }}">
                {{ $statusLabel }}
            </span>
        </div>
    @auth
        </a>
    @else
        </button>
    @endauth
@endforeach
