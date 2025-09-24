@extends('mobile.template.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/Content/mobile/promotion.css') }}">
@endpush
@section('content')
    <div class="promotion-info">
        <div class="promotion-item-details">
            <div class="promotion-title">
                <img src="{{ asset('/storage/'.$promotion->thumb) }}" alt="{{ $promotion->title }}">
                <span>{{ $promotion->title }}</span>
            </div>

            <span>
                Tanggal akhir:
                @if ($promotion->is_lifetime || !$promotion->end_date)
                    -
                @else
                    {{ \Carbon\Carbon::parse($promotion->end_date)->format('d-M-Y') }}
                @endif
            </span>

            <div class="promotion-share-container">
                <button type="button" class="promotion-share-btn" data-toggle="modal"
                    data-target="#promotion_share_{{ $promotion->slug }}">
                    Bagikan
                    <img alt="Share" loading="lazy"
                        src="//dsuown9evwz4y.cloudfront.net/Images/icons/share.svg?v=20250528">
                </button>
            </div>
        </div>

        <div class="promotion-content">
            {!! $promotion->description !!}
        </div>

        {{-- Modal share --}}
        <div id="promotion_share_{{ $promotion->slug }}" class="modal promotion-popup-container" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Bagikan Link Promo</h4>
                    </div>

                    <div class="modal-body promotion-popup-body">
                        <img src="{{ asset('/storage/'.$promotion->thumb) }}" alt="{{ $promotion->title }}">
                        <h4>{{ $promotion->title }}</h4>

                        <div class="promotion-social-media">
                            <input type="hidden" class="promotion_link"
                                value="{{ url('/promotion/details/' . $promotion->slug) }}">

                            {{-- Salin link --}}
                            <div class="social-media-item">
                                <button class="copy-promotion-button copy_promotion_button">
                                    <img alt="Copy" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/icons/copy-round.svg?v=20250528">
                                </button>
                                <span>Salin Link</span>
                            </div>

                            {{-- Facebook --}}
                            <div class="social-media-item">
                                <button data-sharer="facebook"
                                    data-title="{{ $promotion->title }} 
Join di LIGAMANSION2 dan dapatkan bonus menarik setiap harinya, jangan sampai ketinggalan!  
Syarat dan ketentuan berlaku!"
                                    data-url="{{ url('/promotion/details/' . $promotion->slug) }}">
                                    <img alt="Facebook" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/icons/facebook-round.svg?v=20250528">
                                </button>
                                <span>Facebook</span>
                            </div>

                            {{-- WhatsApp --}}
                            <div class="social-media-item">
                                <button data-sharer="whatsapp"
                                    data-title="{{ $promotion->title }} 
Join di LIGAMANSION2 dan dapatkan bonus menarik setiap harinya, jangan sampai ketinggalan!  
Syarat dan ketentuan berlaku!"
                                    data-url="{{ url('/promotion/details/' . $promotion->slug) }}">
                                    <img alt="Whatsapp" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/icons/whatsapp-round.svg?v=20250528">
                                </button>
                                <span>WhatsApp</span>
                            </div>

                            {{-- Telegram --}}
                            <div class="social-media-item">
                                <button data-sharer="telegram"
                                    data-title="{{ $promotion->title }} 
Join di LIGAMANSION2 dan dapatkan bonus menarik setiap harinya, jangan sampai ketinggalan!  
Syarat dan ketentuan berlaku!"
                                    data-url="{{ url('/mobile/promotion/details/' . $promotion->slug) }}">
                                    <img alt="Telegram" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/icons/telegram-round.svg?v=20250528">
                                </button>
                                <span>Telegram</span>
                            </div>

                            {{-- Twitter / X --}}
                            <div class="social-media-item">
                                <button data-sharer="twitter"
                                    data-title="{{ $promotion->title }} 
Join di LIGAMANSION2 dan dapatkan bonus menarik setiap harinya, jangan sampai ketinggalan!  
Syarat dan ketentuan berlaku!"
                                    data-url="{{ url('/mobile/promotions/details/' . $promotion->slug) }}">
                                    <img alt="Twitter" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/icons/twitter-round.svg?v=20250528">
                                </button>
                                <span>Twitter / X</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
