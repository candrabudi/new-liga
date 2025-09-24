@extends('mobile.template.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/Content/mobile/promotion.css') }}">
@endpush
@section('content')
    <div class="promotion-list" style="margin-top: 20px;">
        @foreach ($promotions as $promotion)
            <div class="promotion-item promotion_item">
                {{-- Gambar promo --}}
                <img src="{{ asset('storage/'.$promotion->thumb) }}" alt="{{ $promotion->title }}">

                <div class="button-container">
                    <div class="promotion-label">
                        <h2>{{ $promotion->title }}</h2>
                        <h3>
                            Tanggal akhir:
                            <span>
                                @if ($promotion->is_lifetime || !$promotion->end_date)
                                    -
                                @else
                                    {{ \Carbon\Carbon::parse($promotion->end_date)->format('d-M-Y') }}
                                @endif
                            </span>
                        </h3>
                    </div>

                    <div>
                        {{-- Jika promo aktif & butuh tombol ambil --}}
                        {{-- @if ($promotion->status === 'active' && !$promotion->is_lifetime && $promotion->end_date)
                            <a href="/mobile/bonus#{{ $promotion->slug }}" class="click-for-get-promo-button">
                                Ambil Promo
                            </a>
                        @endif --}}

                        {{-- Tombol detail --}}
                        <a href="{{ route('promotions.show', $promotion->slug) }}"
                            class="click-for-more-info-button">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
