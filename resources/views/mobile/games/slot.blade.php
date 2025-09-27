@extends('mobile.template.app')
@push('styles')
    <link
        href="{{ asset('Content/Slots/mobile-css.css') }}?v=RX-JXdMKFs9K4m-Mrz_M9z6C-FtLYrUmKZmso4VGeV81"rel="stylesheet" />
@endpush
@section('content')
    <h1 class="slots-title" style="margin-top: 20px;">{{ strtoupper($a) }}</h1>

    <div class="slots-games-container">
        <div class="filter-section">
            <div class="category-filter" id="filter_categories">
                <div class="category-filter-link active" data-category="">
                    Semua permainan
                </div>
            </div>
            <div class="game-search">
                <input type="text" id="filter_input" placeholder="Cari Permainan">
            </div>
        </div>
        <div class="game-list">
            <ul id="game_list" data-is-logged-in="false"
                style="--star-on-icon: url(http://dsuown9evwz4y.cloudfront.net/Images/icons/star-on.svg?v=20250528); --star-off-icon: url(//dsuown9evwz4y.cloudfront.net/Images/icons/star-off.svg?v=20250528);">
            </ul>
        </div>
    </div>

    <div id="game_modal" class="modal game-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-5 game-iamge-field">
                                <div class="game-image-container">
                                    <img id="game_modal_image" />
                                </div>
                                <span id="game_modal_name"></span>
                            </div>
                            <div class="col-xs-7 game-buttons-field" id="game_modal_links">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src='{{ asset('Content/Slots/mobile-js.js') }}?v=RX-JXdMKFs9K4m-Mrz_M9z6C-FtLYrUmKZmso4VGeV81' defer></script>


    <script>
        window.addEventListener('DOMContentLoaded', () => {
            initializeSlotGames({
                directoryPath: 'https://dsuown9evwz4y.cloudfront.net/Images/providers/',
                provider: "{{ strtoupper($a) }}",
                translations: {
                    playNow: 'MAIN',
                    demo: 'COBA',
                }
            });
        });
    </script>



    <script type="text/javascript">
        navigator.serviceWorker.getRegistrations().then(registrations => {
            for (const registration of registrations) {
                registration.unregister();
            }
        });
    </script>
@endpush
