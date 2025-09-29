<?php

use App\Http\Controllers\Player\AccountController;
use App\Http\Controllers\Player\AuthController;
use App\Http\Controllers\Player\ComponentController;
use App\Http\Controllers\Player\ContactController;
use App\Http\Controllers\Player\DepositController;
use App\Http\Controllers\Player\GameController;
use App\Http\Controllers\Player\HomeController;
use App\Http\Controllers\Player\PromotionController;
use App\Http\Controllers\Player\WithdrawController;
use App\Http\Controllers\Secret\SAdjustmentController;
use App\Http\Controllers\Secret\SAuthController;
use App\Http\Controllers\Secret\SBannerController;
use App\Http\Controllers\Secret\SChannelController;
use App\Http\Controllers\Secret\SContactController;
use App\Http\Controllers\Secret\SDashboardController;
use App\Http\Controllers\Secret\SDepositController;
use App\Http\Controllers\Secret\SFinanceController;
use App\Http\Controllers\Secret\SMemberController;
use App\Http\Controllers\Secret\SPaymentOwnerController;
use App\Http\Controllers\Secret\SProfileController;
use App\Http\Controllers\Secret\SPromotionController;
use App\Http\Controllers\Secret\SWebsiteController;
use App\Http\Controllers\Secret\SWithdrawController;
use App\Http\Controllers\UpdateGameController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return redirect('/');
});

Route::get('/update/game', [UpdateGameController::class, 'getGameList']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home/menu-games', [ComponentController::class, 'providers'])->name('providers');
Route::get('/mobile/register', [AuthController::class, 'register'])->name('mobile.register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login/process', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('/register/process', [AuthController::class, 'registerProcess'])->name('register.process');
Route::get('/mobile/slots/{a}', [GameController::class, 'slot'])->name('slot');
Route::get('mobile/slots/games/{a}', [GameController::class, 'games'])->name('games');
Route::get('mobile/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::get('mobile/promotions', [PromotionController::class, 'index'])->name('promotions.index');
Route::get('mobile/promotions/details/{slug}', [PromotionController::class, 'show'])->name('promotions.show');
Route::get('import', [GameController::class, 'import'])->name('import');

Route::middleware(['auth'])->group(function () {
    Route::get('/mobile/register-done', [AuthController::class, 'registerDone'])
        ->name('mobile.register.done');

    Route::get('/mobile/deposit/bank', [DepositController::class, 'bank'])
        ->name('mobile.deposit.bank');

    Route::get('/mobile/deposit/emoney', [DepositController::class, 'emoney'])
        ->name('mobile.deposit.emoney');

    Route::get('/mobile/deposit/qris', [DepositController::class, 'qris'])
        ->name('mobile.deposit.qris');

    Route::get('/mobile/withdrawal', [WithdrawController::class, 'index'])
        ->name('mobile.withdrawal.index');

    Route::post('/Wallet/BankDeposit', [DepositController::class, 'storeBank'])
        ->name('wallet.deposit.store.bank');

    Route::post('/Wallet/withdrawal', [WithdrawController::class, 'store'])
        ->name('wallet.withdrawal.store');

    Route::post('/Wallet/QrDeposit', [DepositController::class, 'storeQris'])
        ->name('wallet.deposit.store.qris');

    Route::get('/mobile/account-summary', [AccountController::class, 'accountSummary'])
        ->name('account.summary');

    Route::get('/mobile/password', [AccountController::class, 'password'])
        ->name('account.password');

    Route::post('/Profile/Password', [AccountController::class, 'updatePassword']);

    Route::get('/secret/games/play/{providerId}/{gameCode}', [GameController::class, 'playGame'])
        ->name('secret.games.play');

    Route::get('/secret/games/play/{providerId}/{gameCode}', [GameController::class, 'playGame'])
        ->name('secret.games.play');

    Route::get('/update-balance', [AccountController::class, 'updateBalance']);
});

Route::prefix('secret')->as('secret.')->group(function () {
    Route::get('/website', [SWebsiteController::class, 'index'])
        ->name('website.index');

    Route::post('/website', [SWebsiteController::class, 'storeOrUpdate'])
        ->name('website.storeOrUpdate');

    Route::controller(SAuthController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'loginProcess')->name('login.process');
        Route::post('logout', 'logout')->name('logout');
    });

    // 👑 Protected Routes
    Route::middleware('auth')->group(function () {
        // Dashboard
        Route::get('dashboard', [SDashboardController::class, 'index'])->name('dashboard');

        // 📢 Banners
        Route::prefix('banners')->as('banners.')->controller(SBannerController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::post('update/{id}', 'update')->name('update');
            Route::delete('delete/{id}', 'destroy')->name('destroy');
        });

        // 💰 Deposits
        Route::prefix('deposits')->as('deposits.')->controller(SDepositController::class)->group(function () {
            // Pending
            Route::get('pending', 'pending')->name('pending');
            Route::get('pending/list', 'pendingDeposits')->name('pending.list');
            Route::post('{id}/approve', 'approve')->name('approve');
            Route::post('{id}/reject', 'reject')->name('reject');

            // History
            Route::get('history', 'history')->name('history');
            Route::get('history/list', 'historyList')->name('history.list');
        });

        // 💸 Withdraws
        Route::prefix('withdraws')->as('withdraws.')->controller(SWithdrawController::class)->group(function () {
            // Pending
            Route::get('pending', 'pending')->name('pending');
            Route::get('pending/list', 'pendingWithdraws')->name('pending.list');
            Route::post('{id}/approve', 'approve')->name('approve');
            Route::post('{id}/reject', 'reject')->name('reject');

            // History
            Route::get('history', 'history')->name('history');
            Route::get('history/list', 'historyList')->name('history.list');
        });

        // 👥 Members
        Route::prefix('/members')->as('members.')->controller(SMemberController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/list', 'list')->name('list');
            Route::get('/{id}', 'show')->name('show'); // untuk load data edit
            Route::put('/{id}', 'update')->name('update');
        });

        Route::prefix('finance-settings')->as('finance.')->controller(SFinanceController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });

        Route::prefix('payment-owners')->as('payment_owners.')->controller(SPaymentOwnerController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::put('update/{id}', 'update')->name('update');
            Route::delete('delete/{id}', 'destroy')->name('destroy');
        });

        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::get('/', [SContactController::class, 'index'])->name('index');
            Route::post('/store', [SContactController::class, 'store'])->name('store');
            Route::post('/update/{contact}', [SContactController::class, 'update'])->name('update');
            Route::delete('/delete/{contact}', [SContactController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('adjustments')->name('adjustments.')->group(function () {
            Route::get('/', [SAdjustmentController::class, 'index'])->name('index');
            Route::post('/store', [SAdjustmentController::class, 'store'])->name('store');
            Route::get('/list', [SAdjustmentController::class, 'list'])->name('list');
        });

        Route::prefix('promotions')->as('promotions.')->controller(SPromotionController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('list', 'list')->name('list');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{promotion}/edit', 'edit')->name('edit');
            Route::put('{promotion}', 'update')->name('update');
            Route::delete('{promotion}', 'destroy')->name('destroy');
        });

        Route::prefix('/channels')->name('channels.')->group(function () {
            Route::get('/', [SChannelController::class, 'index'])->name('index');
            Route::get('/list', [SChannelController::class, 'list'])->name('list');
            Route::post('/', [SChannelController::class, 'store'])->name('store');
            Route::get('/{id}', [SChannelController::class, 'show'])->name('show');
            Route::put('/{id}', [SChannelController::class, 'update'])->name('update');
            Route::delete('/{id}', [SChannelController::class, 'destroy'])->name('destroy');
        });
        Route::get('profile', [SProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [SProfileController::class, 'update'])->name('profile.update');

        Route::get('provider-credentials', [App\Http\Controllers\Secret\SProviderCredentialController::class, 'index'])->name('provider.index');
        Route::post('provider-credentials/store-or-update', [App\Http\Controllers\Secret\SProviderCredentialController::class, 'storeOrUpdate'])->name('provider.storeOrUpdate');
    });
});
