@extends('mobile.template.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('Content/mobile/contact-us.css') }}">
@endpush
@section('content')
    @php
        use App\Models\Contact;
        use App\Models\Website;
        $contacts = Contact::all();
        $website = Website::first();
    @endphp
    <div class="standard-form-container" bis_skin_checked="1">
        <div class="container" bis_skin_checked="1">
            <div class="row" bis_skin_checked="1">
                <div class="col-sm-12" bis_skin_checked="1">
                    <div class="contact-us-container" bis_skin_checked="1">
                        <a href="javascript:void(0)" class="js_live_chat_link live-chat-link"
                            data-url="{{ $website->link_livechat }}" data-type="live-chat"
                            style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/communications/live-chat.svg?v=20250528);">
                            <h3>Dukungan 24 Jam</h3>
                            <h6>
                                klik disini
                                <i>
                                    <img alt="Chevron Right" loading="lazy"
                                        src="//dsuown9evwz4y.cloudfront.net/Images/icons/chevron-right.svg?v=20250528">
                                </i>
                            </h6>
                        </a>
                        @foreach ($contacts as $contact)
                            @if ($contact->platform == 'telegram')
                                <a href="{{ $contact->link }}" target="_blank" rel="noopener nofollow" data-type="telegram"
                                    style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/communications/telegram.svg?v=20250528);">
                                    <h3>{{ '@' . $contact->name }}</h3>
                                    <h6>
                                        klik disini
                                        <i>
                                            <img alt="Chevron Right" loading="lazy"
                                                src="//dsuown9evwz4y.cloudfront.net/Images/icons/chevron-right.svg?v=20250528">
                                        </i>
                                    </h6>
                                </a>
                            @endif

                            @if ($contact->platform == 'whatsapp')
                                <a href="{{ $contact->link }}" target="_blank" rel="noopener nofollow" data-type="whatsapp"
                                    style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/communications/whatsapp.svg?v=20250528);">
                                    <h3>{{ $contact->name }}</h3>
                                    <h6>
                                        klik disini
                                        <i>
                                            <img alt="Chevron Right" loading="lazy"
                                                src="//dsuown9evwz4y.cloudfront.net/Images/icons/chevron-right.svg?v=20250528">
                                        </i>
                                    </h6>
                                </a>
                            @endif

                            @if ($contact->platform == 'line')
                                <a href="{{ $contact->link }}" target="_blank" rel="noopener nofollow" data-type="line"
                                    style="--image-src: url(//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/communications/line.svg?v=20250528);">
                                    <h3>{{ $contact->name }}</h3>
                                    <h6>
                                        klik disini
                                        <i>
                                            <img alt="Chevron Right" loading="lazy"
                                                src="//dsuown9evwz4y.cloudfront.net/Images/icons/chevron-right.svg?v=20250528">
                                        </i>
                                    </h6>
                                </a>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
