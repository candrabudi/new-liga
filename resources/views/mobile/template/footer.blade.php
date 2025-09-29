@php
    use App\Models\Contact;
    $contacts = Contact::all();
@endphp

<footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <section class="footer-contacts" itemprop="contactPoint" itemscope itemtype="https://schema.org/ContactPoint">
        <h2>Hubungi {{ $website->website_name }}</h2>
        <ul class="contact-list">
            @foreach ($contacts as $contact)
                @if ($contact->platform == 'telegram')
                    <li>
                        <a href="{{ $contact->link }}" target="_blank" rel="noopener nofollow"
                            aria-label="Telegram {{ $contact->name }}">
                            <img alt="Telegram {{ $contact->name }}" height="18" width="18" loading="lazy"
                                src="http://dsuown9evwz4y.cloudfront.net/Images/communications/telegram.svg?v=20250528" />
                            {{ '@' . $contact->name }}
                        </a>
                    </li>
                @endif

                @if ($contact->platform == 'whatsapp')
                    <li>
                        <a href="{{ $contact->link }}" target="_blank" rel="noopener nofollow"
                            aria-label="WhatsApp {{ $contact->name }}">
                            <img alt="WhatsApp {{ $contact->name }}" height="18" width="18" loading="lazy"
                                src="http://dsuown9evwz4y.cloudfront.net/Images/communications/whatsapp.svg?v=20250528" />
                            {{ $contact->name }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </section>

    <section class="footer-payments">
        <h2>Metode Pembayaran Resmi {{ $website->website_name }}</h2>
        <ul class="bank-list">
            @php
                use App\Models\PaymentOwner;
                $payOwnersFooter = PaymentOwner::where('is_active', 1)->get();
            @endphp
            @foreach ($payOwnersFooter as $payfoot)
                <li>
                    <picture>
                        <source srcset="{{ asset('storage/' . $payfoot->channel->logo) }}" type="image/webp" />
                        <source srcset="{{ asset('storage/' . $payfoot->channel->logo) }}" type="image/png" />
                        <img alt="Logo Bank {{ $payfoot->channel->name ?? 'Payment' }}" width="80" height="40"
                            loading="lazy" src="{{ asset('storage/' . $payfoot->channel->logo) }}" />
                    </picture>
                </li>
            @endforeach
        </ul>
    </section>

    <!-- Navigasi Footer -->
    <nav class="footer-links" aria-label="Footer Navigation">
        <ul>
            <li><a href="about-us.html">Tentang {{ $website->website_name }}</a></li>
            <li><a href="responsible-gaming.html">Responsible Gambling</a></li>
            <li><a href="faq.html">Pusat Bantuan</a></li>
            <li><a href="terms-of-use.html">Syarat & Ketentuan</a></li>
        </ul>
    </nav>

    <!-- Deskripsi SEO -->
    <section class="site-description">
        <h2>{{ $website->website_name }}: Situs Slot Online Gacor Terpercaya 2025</h2>
        <p>Selamat datang di {{ $website->website_name }} – platform judi slot online gacor, slot88 resmi terpercaya di
            Indonesia dengan RTP tinggi, bonus instan, dan dukungan CS 24/7.</p>

        <h3>Game & Layanan Terbaik</h3>
        <ul>
            <li>Slot Gacor RTP Tertinggi (Pragmatic Play, PG Soft, Habanero, Microgaming, dsb)</li>
            <li>Live Casino & Sportsbook</li>
            <li>Poker Online & Tembak Ikan</li>
            <li>Deposit mudah via Bank, E-Wallet & QRIS</li>
        </ul>

        <p><a href="#">👉 Daftar {{ $website->website_name }} sekarang & nikmati jackpot harian!</a></p>
    </section>

    <!-- Copyright -->
    <div class="copyright"
        style="background-image:url(../../dsuown9evwz4y.cloudfront.net/Images/_normad-alpha/dark-gold/mobile/layout/footer-backgrounde252.jpg?v=20250528);">
        <p>©2025 {{ $website->website_name }}. Semua Hak Cipta Dilindungi.</p>
        <a href="https://ambengine.com/" target="_blank" rel="nofollow noopener" class="powered-by-link">
            <img alt="Powered by AMB Engine" height="30" loading="lazy"
                src="//dsuown9evwz4y.cloudfront.net/Images/~normad-alpha/dark-gold/mobile/platform-engine/amb-engine.png?v=20250528" />
        </a>
    </div>
</footer>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "{{ $website->website_name }}",
  "url": "{{ url('/') }}",
  "logo": "{{ asset($website->website_logo) }}",
  "sameAs": [
    @foreach ($contacts as $contact)
      "{{ $contact->link }}"@if(!$loop->last),@endif
    @endforeach
  ],
  "contactPoint": [{
    "@type": "ContactPoint",
    "contactType": "customer service",
    "availableLanguage": ["Indonesian", "English"]
  }]
}
</script>
