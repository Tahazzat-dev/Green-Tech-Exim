@extends('layouts.app')
@section('content')
@include("partials.header")
  <div class="container flex-1 flex flex-col w-full mx-auto">
      <button
        class="link-text"
      >
        <svg  class="min-w-5 size-5 lg:size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M73.4 297.4C60.9 309.9 60.9 330.2 73.4 342.7L233.4 502.7C245.9 515.2 266.2 515.2 278.7 502.7C291.2 490.2 291.2 469.9 278.7 457.4L173.3 352L544 352C561.7 352 576 337.7 576 320C576 302.3 561.7 288 544 288L173.3 288L278.7 182.6C291.2 170.1 291.2 149.8 278.7 137.3C266.2 124.8 245.9 124.8 233.4 137.3L73.4 297.3z"/></svg>
      </button>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start bg-white rounded-3xl p-5 md:p-8 shadow-md dark:bg-slate-900 border border-slate-100 dark:border-slate-800">
        
        {/* Left Side Col 1: Large Illustration Block with absolute previews matching Screen 6 */}
        <div class="lg:col-span-5 flex flex-col items-center">
          <div class="relative aspect-square w-full rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100/40 p-6 flex items-center justify-center border border-slate-50 dark:from-slate-950 dark:to-slate-950/60 dark:border-slate-800">
            <img
              src={trophy.imageUrl}
              alt={trophy.name}
              class="h-full w-full object-contain drop-shadow-lg"
              referrerPolicy="no-referrer"
            />
            
            {/* "Preview" Green Badge button overlay matching PDF Screen 6 */}
            <div class="absolute top-4 left-1/2 -translate-x-1/2">
              <span class="rounded-full bg-primary px-5 py-1 text-xs font-bold text-white shadow-sm tracking-wide">
                Preview
              </span>
            </div>

            {/* Quality check sign */}
            <span class="absolute bottom-3 right-3 text-[10px] bg-[#10235a] dark:bg-slate-800 text-white font-mono uppercase tracking-widest font-black px-2 py-0.5 rounded">
              Original Import
            </span>
          </div>

          <p class="mt-3 text-[10px] text-slate-400 font-bold dark:text-slate-500 text-center">
            Illustration represents dual-cup gold premium variants. Models may vary depending on active size configurations.
          </p>
        </div>

        {/* Right Side Col 2: Specifications, price tables and action buttons exactly matching Screen 6 mockup */}
        <div class="lg:col-span-7 space-y-6">
          
          {/* Header detail */}
          <div>
            <span class="text-[10px] font-bold text-primary dark:text-primary-500 uppercase tracking-widest block font-mono">
              📂 Category: {category?.name || 'Metal Trophy'}
            </span>
            <h2 class="text-2xl font-black text-[#10235a] dark:text-white mt-1 leading-tight tracking-tight">
              {trophy.name}
            </h2>
            <p class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase mt-1">
              Ref Code &bull; {trophy.model} series
            </p>
          </div>

          {/* Description Block */}
          {trophy.description && (
            <div class="border-l-2 border-slate-200 dark:border-slate-700 pl-4 py-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400 font-medium">
              {trophy.description}
            </div>
          )}

          {/* Sizing Detail Table exactly like PDF Screen 6 specifications grid */}
          <div class="rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-slate-50 dark:bg-slate-950/40">
            {/* Table Header */}
            <div class="grid grid-cols-2 bg-[#10235a]/10 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 px-4 py-2.5 text-[11px] font-bold text-slate-700 dark:text-slate-300">
              <span>MODEL &amp; ACCENTS</span>
              <span class="text-right">DIMENSIONS TIER</span>
            </div>
            
            {/* Sizes Rows Matching design with ROYAL GLORY line items */}
            <div class="divide-y divide-slate-100 dark:divide-slate-800/60 font-mono text-xs text-slate-800 dark:text-slate-200">
              <div class="grid grid-cols-2 px-4 py-3">
                <span class="font-bold text-slate-500 dark:text-slate-400">Class A Model Specs</span>
                <span class="text-right font-black text-secondary dark:text-primary-500">{trophy.sizeCodeA}</span>
              </div>
              <div class="grid grid-cols-2 px-4 py-3">
                <span class="font-bold text-slate-500 dark:text-slate-400">Class B Model Specs</span>
                <span class="text-right font-black text-secondary dark:text-primary-500">{trophy.sizeCodeB}</span>
              </div>
            </div>
          </div>

          {/* Status and Pricing Tier block */}
          <div class="flex flex-wrap items-center justify-between gap-4 rounded-2xl bg-slate-50 p-4 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800">
            <div>
              <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block">
                Wholesale Price Scheme
              </span>
              <p class="text-sm font-black text-[#10235a] dark:text-white leading-relaxed mt-0.5">
                Price : <span class="text-[#67af42] text-base">{trophy.priceA} tk</span> (A) / <span class="text-[#67af42] text-base">{trophy.priceB} tk</span> (B)
              </p>
            </div>

            {/* In Stock or Stock Out */}
            <div>
              <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider block text-right">
                Warehouse Status
              </span>
              <div class="mt-1">
                {trophy.inStock ? (
                  <span class="inline-flex items-center gap-1 rounded-full bg-primary/25 text-primary dark:text-primary-500 font-extrabold px-3 py-1 text-xs">
                    <CheckCircle2 class="h-3.5 w-3.5" /> In Stock
                  </span>
                ) : (
                  <span class="inline-flex items-center gap-1 rounded-full bg-rose-500/20 text-rose-500 dark:text-rose-400 font-extrabold px-3 py-1 text-xs">
                    <AlertCircle class="h-3.5 w-3.5" /> Stock Out
                  </span>
                )}
              </div>
            </div>
          </div>

          {/* Action buttons matching exact design: WhatsApp & Telegram sharing nodes (Screen 6) */}
          <div class="space-y-3.5 pt-3">
            {/* Green button: Chat With Us (whatsapp) */}
            <button
              onClick={handleChatWhatsApp}
              type="button"
              class="btn-primary w-full py-4 rounded-xl text-sm font-bold shadow-md flex items-center justify-center gap-2.5 click-effect cursor-pointer"
            >
              {/* WhatsApp stylized phone icon */}
              <MessageSquare class="h-5 w-5 fill-white stroke-none" />
              <span>Chat With Us</span>
            </button>

            {/* Blue button: Send Product Details (telegram) */}
            <button
              onClick={handleShareTelegram}
              type="button"
              class="btn-secondary w-full py-4 rounded-xl text-sm font-extrabold shadow-md flex items-center justify-center gap-2.5 click-effect cursor-pointer"
            >
              <Send class="h-5 w-5" />
              <span>Send Product Details</span>
            </button>
          </div>

          {/* Clipboard quotation quick assistant */}
          <div class="rounded-xl border border-dashed border-slate-200 p-3 text-center dark:border-slate-800">
            <button
              onClick={() => {
                navigator.clipboard.writeText(
                  `Green Tech Exim order quote:\n${trophy.name} (${trophy.model})\nPrice A: ${trophy.priceA} tk, Price B: ${trophy.priceB} tk.`
                );
                alert('Sales quotation copied to your device clipboard! Feel free to paste to our team.');
              }}
              class="text-[11px] font-bold text-indigo-500 dark:text-primary-500 underline"
            >
              📋 Click here to copy simple sales quotation for fast chat copy-paste
            </button>
          </div>
        </div>

      </div>
    </div>
@endsection
