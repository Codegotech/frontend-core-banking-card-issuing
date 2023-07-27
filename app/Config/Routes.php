<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();


 // custom create routes 
$routes->get('/', 'User::login');

$routes->match(["get","post"],"signup", "User::signup");
$routes->match(["get","post"],"verify-email", "User::verifyemail");
$routes->match(["get","post"],"otp", "User::otp");

$routes->get('/register', 'User::index');
$routes->post('user/registerAuth', 'User::registerAuth');
$routes->get('/login', 'User::login');
$routes->get('/dashboard', 'User::dashboard', ['filter' => 'authGuard']);
$routes->get('/wallet-detail/(:any)', 'User::wallet_detail/$1', ['filter' => 'authGuard']);

$routes->post('/crypto/withdrawtrx', 'Crypto::withdrawtrx', ['filter' => 'authGuard']);
$routes->post('/crypto/confirm_withdrawtrx', 'Crypto::confirm_withdrawtrx', ['filter' => 'authGuard']);

$routes->post('/crypto/move_debit_crypto', 'Crypto::move_debit_crypto', ['filter' => 'authGuard']);
$routes->post('/crypto/confirm_move_debit_crypto', 'Crypto::confirm_move_debit_crypto', ['filter' => 'authGuard']);

$routes->get('/crypto/submit_exchange', 'Crypto::submit_exchange', ['filter' => 'authGuard']);
$routes->get('/crypto/cancel_exchnage', 'Crypto::cancel_exchnage', ['filter' => 'authGuard']);
$routes->post('/crypto/confirm_exchange', 'Crypto::confirm_exchange', ['filter' => 'authGuard']);
$routes->get('/crypto/exchange/(:any)', 'Crypto::exchange/$1', ['filter' => 'authGuard']);
$routes->post('/crypto/exchange_post/(:any)', 'Crypto::exchange_post/$1', ['filter' => 'authGuard']);
$routes->get('/crypto', 'Crypto::index', ['filter' => 'authGuard']);
$routes->get('/crypto/getTrx', 'Crypto::getTrx', ['filter' => 'authGuard']);
$routes->post('/crypto/withdraw_euro', 'Crypto::withdraw_euro', ['filter' => 'authGuard']);
$routes->post('/crypto/confirm_withdraw_euro', 'Crypto::confirm_withdraw_euro', ['filter' => 'authGuard']);
$routes->get('/crypto/wallet/(:any)', 'Crypto::wallet/$1', ['filter' => 'authGuard']);
$routes->get('/crypto/getTrxcoin/(:any)', 'Crypto::getTrxcoin/$1', ['filter' => 'authGuard']);

$routes->post('/movebalancedebittomain', 'User::movebalancedebittomain', ['filter' => 'authGuard']);
$routes->post('/confirmmovebalance', 'User::confirmmovebalance', ['filter' => 'authGuard']);
$routes->post('/movebalancedebit', 'User::movebalancedebit', ['filter' => 'authGuard']);
$routes->post('/wiredeposit', 'User::wiredeposit', ['filter' => 'authGuard']);
$routes->get('/profile', 'User::profile', ['filter' => 'authGuard']);
$routes->get('/uploadkyc', 'User::uploadkyc', ['filter' => 'authGuard']);
$routes->post('/uploadkyc', 'User::uploadkyc', ['filter' => 'authGuard']);
$routes->post('/login','Home::login'); 
$routes->post('user/loginAuth', 'User::loginAuth');
$routes->post('/register', 'User::register');
$routes->get('/logout', 'User::logout');

$routes->get('/forgot-password', 'User::forgot_password');
$routes->post('/forgot-password', 'User::forgot_password');
$routes->get('/verify-forgot-password', 'User::verify_forgot_password');
$routes->post('/verify-forgot-password', 'User::verify_forgot_password');

$routes->get('/authenticate', 'Auth::index');



$routes->post('/creategiftcard', 'Giftcard::creategiftcard');
$routes->post('/createhsgiftcard', 'Giftcard::createhsgiftcard');
$routes->get('/giftcards', 'Giftcard::index');
$routes->get('/hs-giftcards', 'Giftcard::hscards');
$routes->get('/giftcards/view/(:any)', 'Giftcard::view/$1');
$routes->get('/hsgiftcards-detail/(:any)', 'Giftcard::detail/$1');
$routes->get('/giftcards/block/(:any)', 'Giftcard::block/$1');
$routes->get('/block-hscard/(:any)', 'Giftcard::hsblock/$1');
$routes->get('/unblock-hscard/(:any)', 'Giftcard::hsunblock/$1');
$routes->get('/updatekyc/(:any)', 'User::updatekyc/$1', ['filter' => 'authGuard']);
$routes->post('/updatekyc/(:any)', 'User::updatekyc/$1', ['filter' => 'authGuard']);

/*prepaid */
$routes->get('/prepaidcard', 'Prepaidcard::index', ['filter' => 'cardFilter']);
$routes->post('/prepaidcard', 'Prepaidcard::index', ['filter' => 'cardFilter']);
$routes->get('/prepaid-ordercard', 'Prepaidcard::ordercard', ['filter' => 'cardFilter']);
$routes->post('/prepaid-ordercard', 'Prepaidcard::ordercard', ['filter' => 'cardFilter']);
$routes->post('/prepaid-activatecard', 'Prepaidcard::activatecard', ['filter' => 'cardFilter']);

$routes->get('/prepaid-lock-card/(:any)', 'Prepaidcard::lock_card/$1', ['filter' => 'cardFilter']);
$routes->get('/prepaid-unlock-card/(:any)', 'Prepaidcard::unlock_card/$1', ['filter' => 'cardFilter']);
$routes->get('/prepaid-reset-pin/(:any)', 'Prepaidcard::reset_pin/$1', ['filter' => 'cardFilter']);
$routes->get('/prepaid-block-card/(:any)', 'Prepaidcard::block_card/$1', ['filter' => 'cardFilter']);
$routes->post('/prepaid-loadcard', 'Prepaidcard::loadcard', ['filter' => 'cardFilter']);
$routes->get('/prepaid-transactions/(:any)', 'Prepaidcard::transactions/$1', ['filter' => 'cardFilter']);

/*Debitcard */
$routes->get('/debitcard', 'Debitcard::index', ['filter' => 'authGuard']);
$routes->post('/debitcard', 'Debitcard::index', ['filter' => 'authGuard']);
$routes->get('/debitcard-ordercard', 'Debitcard::ordercard', ['filter' => 'authGuard']);
$routes->post('/debitcard-ordercard', 'Debitcard::ordercard', ['filter' => 'authGuard']);
$routes->post('/debitcard-activatecard', 'Debitcard::activatecard', ['filter' => 'authGuard']);

$routes->get('/debitcard-lock-card/(:any)', 'Debitcard::lock_card/$1', ['filter' => 'authGuard']);
$routes->get('/debitcard-unlock-card/(:any)', 'Debitcard::unlock_card/$1', ['filter' => 'authGuard']);
$routes->get('/debitcard-reset-pin/(:any)', 'Debitcard::reset_pin/$1', ['filter' => 'authGuard']);
$routes->get('/debitcard-transactions/(:any)', 'Debitcard::transactions/$1', ['filter' => 'authGuard']);
$routes->get('/debitcard-block-card', 'Debitcard::block_card', ['filter' => 'authGuard']);
$routes->post('/debitcard-loadcard', 'Debitcard::loadcard', ['filter' => 'authGuard']);

$routes->get('/debitcard-portfolio', 'Debitcard::portfolio', ['filter' => 'authGuard']);
$routes->post('/debitcard-portfolio', 'Debitcard::portfolio', ['filter' => 'authGuard']);
$routes->get('/debitcard-settings', 'Debitcard::settings', ['filter' => 'authGuard']);
$routes->post('/debitcard-settings', 'Debitcard::settings', ['filter' => 'authGuard']);
$routes->get('/debitcard-sort', 'Debitcard::sort', ['filter' => 'authGuard']);
$routes->post('/debitcard-sort', 'Debitcard::sort', ['filter' => 'authGuard']);

/*Transactions */
$routes->get('/clear-transactions', 'Transaction::clear', ['filter' => 'authGuard']);
$routes->get('/transactions', 'Transaction::index', ['filter' => 'authGuard']);
$routes->post('/transactions', 'Transaction::index', ['filter' => 'authGuard']);

$routes->get('/transaction-detail/(:any)', 'Transaction::transactions_details/$1', ['filter' => 'authGuard']);
$routes->post('/transaction-detail/(:any)', 'Transaction::transactions_details/$1', ['filter' => 'authGuard']);

$routes->get('/prepaid-transactions-list', 'Transaction::prepaid_transaction', ['filter' => 'authGuard']);
$routes->get('/prepaid-transactions-detail/(:any)', 'Transaction::prepaid_transaction_details/$1', ['filter' => 'authGuard']);


$routes->get('/debitcard-transactions-list', 'Transaction::debitcard_transaction', ['filter' => 'authGuard']);
$routes->get('/debitcard-refunds-completed', 'Transaction::debitcard_refunds_completed', ['filter' => 'authGuard']);
$routes->get('/debitcard-refunds-pending', 'Transaction::debitcard_refunds_pending', ['filter' => 'authGuard']);
$routes->get('/debitcard-transactions-detail/(:any)', 'Transaction::debitcard_transaction_details/$1', ['filter' => 'authGuard']);

/*Beneficiary */
$routes->get('/beneficiaries', 'Beneficiary::index', ['filter' => 'authGuard']);
$routes->post('/beneficiaries', 'Beneficiary::index', ['filter' => 'authGuard']);
$routes->get('/add-beneficiary', 'Beneficiary::add', ['filter' => 'authGuard']);
$routes->post('/add-beneficiary', 'Beneficiary::add', ['filter' => 'authGuard']);
$routes->post('/add-beneficiary', 'Beneficiary::add', ['filter' => 'authGuard']);

$routes->get('/beneficiaries-sendmoney', 'Beneficiary::sendmoney', ['filter' => 'authGuard']);
$routes->post('/beneficiaries-sendmoney', 'Beneficiary::sendmoney', ['filter' => 'authGuard']);

$routes->get('/delete-beneficiary/(:any)', 'Beneficiary::delete/$1', ['filter' => 'authGuard']);


// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
