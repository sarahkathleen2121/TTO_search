@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/enquiry-basket.css') }}">

    <main class="container">
        <h1 class="eb-title">Enquiry basket</h1>

        <div class="row g-5">
            <!-- Items column -->
            <div class="col-lg-8">
                <div class="row eb-head d-none d-lg-flex">
                    <div class="col-8">Item</div>
                    <div class="col-4 text-center">QTY</div>
                </div>
                
                @if(isset($items) && count($items) > 0)
                    @foreach($items as $item)
                    <!-- Item -->
                    <div class="row eb-item align-items-center" data-id="{{ $item['id'] }}">
                        <div class="col-12 col-lg-8 d-flex align-items-center gap-4">
                            <div class="eb-thumb">
                                <img src="{{ $item['thumbnail_url'] ?? asset('frontend_assets/images/banner_img.png') }}" style="width:100%;height:100%;object-fit:cover;" alt="{{ $item['name'] }}">
                            </div>
                            <div>
                                <p class="eb-name"><a href="{{ route('product.detail', $item['slug']) }}" class="text-decoration-none text-dark">{{ $item['name'] }}</a></p>
                                <div class="mt-3">
                                    <span class="eb-icon" title="Bookmark"><i class="fa-regular fa-bookmark"></i></span>
                                    <span class="eb-icon remove-item" title="Remove" style="cursor:pointer;"><i class="fa-regular fa-trash-can text-danger"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 d-flex justify-content-lg-center mt-3 mt-lg-0">
                            <div class="eb-qty">
                                <button class="eb-dec" type="button">-</button>
                                <input class="eb-count" type="number" min="1" value="{{ $item['qty'] }}" />
                                <button class="eb-inc" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <h4 class="text-muted">Your enquiry basket is empty.</h4>
                        <a href="{{ route('all.products') }}" class="btn btn-primary mt-3">Browse Products</a>
                    </div>
                @endif
            </div>

            <!-- Summary column -->
            <div class="col-lg-4">
                <div class="eb-summary">
                    <h6>Enquiry Summary</h6>
                    <div class="d-flex justify-content-between mt-4">
                        <span>Items</span>
                        <span class="text-primary fw-bold" id="ebItemCount">0</span>
                    </div>
                    <button class="eb-cta" @if(empty($items)) disabled style="opacity:0.5;" @endif>Request a Quote</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        (function() {
            function recalc() {
                let totalQty = 0;
                document.querySelectorAll('.eb-item').forEach(function(row) {
                    const qty = Math.max(1, Number(row.querySelector('.eb-count').value) || 1);
                    totalQty += qty;
                });
                const countEl = document.getElementById('ebItemCount');
                if (countEl) countEl.textContent = totalQty;
            }

            function updateBasketAPI(productId, qty) {
                fetch('{{ route("enquiry.basket.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId, qty: qty })
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        updateBadge();
                    }
                });
            }

            function removeBasketAPI(productId, row) {
                fetch('{{ route("enquiry.basket.remove") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ product_id: productId })
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        row.remove();
                        recalc();
                        updateBadge();
                        if (document.querySelectorAll('.eb-item').length === 0) {
                            window.location.reload();
                        }
                    }
                });
            }

            document.querySelectorAll('.eb-inc').forEach(b => b.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.eb-count');
                const row = this.closest('.eb-item');
                input.value = Number(input.value || 1) + 1;
                recalc();
                updateBasketAPI(row.getAttribute('data-id'), input.value);
            }));

            document.querySelectorAll('.eb-dec').forEach(b => b.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.eb-count');
                const row = this.closest('.eb-item');
                if (Number(input.value) > 1) {
                    input.value = Number(input.value) - 1;
                    recalc();
                    updateBasketAPI(row.getAttribute('data-id'), input.value);
                }
            }));

            document.querySelectorAll('.eb-count').forEach(i => i.addEventListener('change', function() {
                if (this.value < 1) this.value = 1;
                const row = this.closest('.eb-item');
                recalc();
                updateBasketAPI(row.getAttribute('data-id'), this.value);
            }));

            document.querySelectorAll('.remove-item').forEach(b => b.addEventListener('click', function() {
                const row = this.closest('.eb-item');
                removeBasketAPI(row.getAttribute('data-id'), row);
            }));

            recalc();
        })();
    </script>
@endsection
