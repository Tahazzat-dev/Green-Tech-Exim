<?php $__env->startSection('title', $title ?? ($category->name ?? 'Products')); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make("partials.header", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="custom-container flex-1 flex flex-col mx-auto p-4 py-7 md:px-6 lg:p-8 xl:p-10 h-full">
   <div class="w-full flex items-center">
    <button
        type="button"
        data-fallback-url="<?php echo e(route('categories.all')); ?>"
        onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.href = this.dataset.fallbackUrl; }"
        class="md:hidden"
    >
        <svg class="min-w-5 size-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z"/></svg>
    </button>
    <h1 class="text-center font-semibold flex-1 md:flex-none md:mx-auto"><?php echo e($title ?? ($category->name ?? 'Products')); ?></h1>
    <div class="md:hidden min-w-5 size-6"></div>
   </div>

    <div id="product-grid" class="relative w-full pt-5 md:pt-7 gap-4 md:gap-5 grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(250px,1fr))]">
        <?php if($products->isEmpty()): ?>
            <div class="col-span-full text-center py-10">
                <p class="text-text-body">
                    No products found.
                </p>
            </div>
        <?php else: ?>
            <?php echo $__env->make('trophies.partials.product-cards', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    </div>

    <?php if($products->hasMorePages()): ?>
        <div
            class="mt-4 md:mt-5 w-full flex items-center justify-center min-h-[280px] sm:min-h-[320px]"
            x-data="window.trophyInfiniteProducts(<?php echo e(\Illuminate\Support\Js::from($products->nextPageUrl())); ?>, 'product-grid')"
            x-show="nextPageUrl || loading"
            aria-live="polite"
            :aria-busy="loading"
        >
            <svg
                class="size-8 animate-spin text-primary"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    <?php endif; ?>
</div>

<div class="w-full max-h-2 custom-container fixed bottom-0 right-1/2 translate-x-1/2 border">
    <button
        type="button"
        x-data="{ visible: false }"
        x-init="
            const toggle = () => { visible = (window.scrollY || document.documentElement.scrollTop) > 240 };
            toggle();
            window.addEventListener('scroll', toggle, { passive: true });
        "
        x-show="visible"
        x-transition.opacity
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="z-50 flex absolute bottom-5 right-10 lg:right-0 p-2 size-8 items-center justify-center rounded-full bg-primary hover:bg-primary/80 transition-colors duration-300 text-white shadow-lg"
        aria-label="Scroll to top"
        style="display: none;"
    >
        <svg  title="Scroll to top" class="size-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" aria-hidden="true">
            <path d="M342.6 73.4C330.1 60.9 309.8 60.9 297.3 73.4L137.3 233.4C124.8 245.9 124.8 266.2 137.3 278.7C149.8 291.2 170.1 291.2 182.6 278.7L288 173.3L288 544C288 561.7 302.3 576 320 576C337.7 576 352 561.7 352 544L352 173.3L457.4 278.7C469.9 291.2 490.2 291.2 502.7 278.7C515.2 266.2 515.2 245.9 502.7 233.4L342.6 73.4z"/>
        </svg>
    </button>
  </div>


<script>
    window.trophyInfiniteProducts = function (nextPageUrl, gridId) {
        return {
            nextPageUrl,
            loading: false,
            init() {
                this.syncLoaderHeight();

                const grid = document.getElementById(gridId);
                const firstCard = grid?.querySelector(':scope > a, :scope > button');

                if (firstCard) {
                    const resizeObserver = new ResizeObserver(() => this.syncLoaderHeight());
                    resizeObserver.observe(firstCard);
                }

                const observer = new IntersectionObserver((entries) => {
                    if (entries.some((entry) => entry.isIntersecting)) {
                        this.loadMore();
                    }
                }, {
                    root: null,
                    rootMargin: '0px',
                    threshold: 0.25,
                });

                observer.observe(this.$el);
            },
            syncLoaderHeight() {
                const grid = document.getElementById(gridId);
                const firstCard = grid?.querySelector(':scope > a, :scope > button');

                if (!firstCard) {
                    return;
                }

                const height = firstCard.getBoundingClientRect().height;

                if (height > 0) {
                    this.$el.style.minHeight = `${height}px`;
                }
            },
            isLoaderInView() {
                const rect = this.$el.getBoundingClientRect();

                return rect.top < window.innerHeight && rect.bottom > 0;
            },
            async loadMore() {
                if (this.loading || !this.nextPageUrl) {
                    return;
                }

                this.loading = true;

                try {
                    const response = await fetch(this.nextPageUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        return;
                    }

                    const data = await response.json();
                    const grid = document.getElementById(gridId);

                    if (!grid || !data.html) {
                        this.nextPageUrl = data.next_page_url || null;
                        return;
                    }

                    const template = document.createElement('template');
                    template.innerHTML = data.html.trim();

                    Array.from(template.content.childNodes).forEach((node) => {
                        grid.appendChild(node);

                        if (node.nodeType === Node.ELEMENT_NODE && window.Alpine) {
                            window.Alpine.initTree(node);
                        }
                    });

                    this.nextPageUrl = data.next_page_url;
                } finally {
                    this.loading = false;

                    this.$nextTick(() => {
                        if (this.nextPageUrl && this.isLoaderInView()) {
                            this.loadMore();
                        }
                    });
                }
            },
        };
    };
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/tahazzat/works/projects/personal-projects/trophy-app/trophy-app-web/resources/views/trophies/trophies.blade.php ENDPATH**/ ?>