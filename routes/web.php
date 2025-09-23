<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\ManageProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes Auth\LoginController@showSignIn
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::name('auth.')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('signin', [LoginController::class, 'showSignIn'])->name('signin');
        Route::post('signin', [LoginController::class, 'postSignIn'])->name('signin.post');

        Route::get('signup/{refid?}', [RegisterController::class, 'showSignUp'])->name('signup');
        Route::post('signup', [RegisterController::class, 'signUpPost'])->name('signup.post');
        Route::get('mnemonic/show', [RegisterController::class, 'showMnemonic'])->name('mnemonic');

        Route::get('/forgotpassword', [ForgotPasswordController::class, 'showForget'])->name('forgotpassword');
        Route::get('/forgotpassowrd/mnemonic', [ForgotPasswordController::class, 'showMnemonic'])->name('forgotpassword.mnemonic');
        Route::get('/forgotpassword/pgp', [ForgotPasswordController::class, 'showPGP'])->name('forgotpassword.pgp');
        Route::post('/forgotpassword/mnemonic', [ForgotPasswordController::class, 'resetMnemonic']);
        Route::post('/forgotpassword/pgp', [ForgotPasswordController::class, 'sendVerify']);
        Route::get('/forgotpassword/pgp/verify', [ForgotPasswordController::class, 'showVerify'])->name('pgprecover');
        Route::post('/forgotpassword/pgp/verify', [ForgotPasswordController::class, 'resetPgp'])->name('resetpgp');

    });

    Route::get('verify', [LoginController::class, 'showVerify'])->name('verify');
    Route::post('verify', [LoginController::class, 'postVerify'])->name('verify.post');
    Route::post('signout', [LoginController::class, 'postSignOut'])->name('signout.post');
});

Route::prefix('admin')->group(function () {
    Route::middleware(['admin_panel_access'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.index');

        Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');

        //Marketplace Edit (will be permission check WARN1 - look example editCategory (duplicated controller func) )
        Route::post('/marketname', [AdminController::class, 'editMarketName'])->name('admin.marketname.post');
        Route::post('/category', [AdminController::class, 'addMainCategory'])->name('admin.maincategory.post');
        Route::patch('/category', [AdminController::class, 'addSubCategory'])->name('admin.subcategory.post');
        Route::put('/category', [AdminController::class, 'editCategory'])->name('admin.editcategory.post');
        Route::delete('/category', [AdminController::class, 'delCategory'])->name('admin.delcategory.post');
        Route::post('/footer', [AdminController::class, 'editFooter'])->name('admin.footer.post');
        Route::post('/article/{key}', [AdminController::class, 'setPublishArticle'])->name('admin.setpublisharticle.post');
        Route::patch('/article/{key}', [AdminController::class, 'setContentArticle'])->name('admin.articlecontent.post');

        Route::post('/marketpgp', [AdminController::class, 'editMarketPgp'])->name('admin.marketpgp.post');

// LAST ADD on ADMINCP

        Route::get('messages', [AdminController::class, 'messagesView'])->name('admin.usermessages');
        Route::get('reviews', [AdminController::class, 'reviewsView'])->name('admin.reviews');


// Categories routes
        Route::get('categories', [AdminController::class, 'categories'])->name('admin.categories');
        Route::post('category/new', [AdminController::class, 'newCategory'])->name('admin.categories.new');
        Route::get('category/delete/{id}', [AdminController::class, 'removeCategory'])->name('admin.categories.delete');
        Route::get('category/{id}', [AdminController::class, 'editCategoryShow'])->name('admin.categories.show');
        Route::post('category/{id}', [AdminController::class, 'editCategory'])->name('admin.categories.edit');


// Mass message routes
        Route::get('message', [AdminController::class, 'massMessage'])->name('admin.messages.mass');
        Route::post('message/send', [AdminController::class, 'sendMessage'])->name('admin.messages.send');


// User routes
        Route::get('users', [UserController::class, 'users'])->name('admin.users');
        Route::post('users/query', [UserController::class, 'usersPost'])->name('admin.users.query');
        Route::get('users/{user?}', [UserController::class, 'userView'])->name('admin.users.view');

        Route::get('users/make/admin/{user}', [UserController::class, 'makeUserAdmin'])->name('admin.user.makeadmin');

        Route::get('users/ban/{user}', [UserController::class, 'banUser'])->name('admin.user.ban');
        Route::get('users/remove/ban/{user}', [UserController::class, 'removeBan'])->name('admin.ban.remove');

// Log
        Route::get('log', [LogController::class, 'showLog'])->name('admin.log');

        Route::get('purchases', [ManageProductController::class, 'purchases'])->name('admin.purchases');
        Route::get('purchase/{purchase}', [AdminController::class, 'purchase'])->name('admin.purchase');

// Support tickets
        Route::get('tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
        Route::get('ticket/{ticket}', [AdminController::class, 'viewTicket'])->name('admin.tickets.view');
        Route::get('ticket/{ticket}/solve', [AdminController::class, 'solveTicket'])->name('admin.tickets.solve');

// Vendor purchases
        Route::get('vendor/purchases', [AdminController::class, 'vendorPurchases'])->name('admin.vendor.purchases');

// Featured products
        Route::get('products/featured', [ManageProductController::class, 'featuredProductsShow'])->name('admin.featuredproducts.show');
        Route::get('products/featured/mark/{product}', [ManageProductController::class, 'markAsFeatured'])->name('admin.product.markfeatured');

        Route::post('products/featured/remove', [ManageProductController::class, 'removeFromFeatured'])->name('admin.featuredproducts.remove');

// Remove tickets
        Route::post('tickets/remove', [AdminController::class, 'removeTickets'])->name('admin.tickets.remove');
    });
});


// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('banned', [ProfileController::class, 'banned'])->name('profile.banned');
    Route::middleware(['is_banned'])->group(function () {
        /**
         * All routes related to user profile
         * Grouped under the prefix "profile" and under auth middleware
         */
        Route::prefix('profile')->group(function () {
            Route::get('index', [ProfileController::class, 'index'])->name('profile.index');

            Route::get('settings', [ProfileController::class, 'settingsView'])->name('profile.settings');
            Route::get('wallet', [ProfileController::class, 'walletView'])->name('profile.wallet');
            Route::post('wallet/withdraw', [ProfileController::class, 'withdrawXmr'])->name('user.withdrawxmr.post');
            Route::get('invites', [ProfileController::class, 'invitesView'])->name('profile.invites');

            Route::post('changepassword', [ProfileController::class, 'changePassword'])->name('profile.password.change'); // change password route
            Route::post('changepin', [ProfileController::class, 'changePin'])->name('profile.pin.change');
            Route::get('2fa/{turn}', [ProfileController::class, 'change2fa'])->name('profile.2fa.change'); // change 2fa
            Route::post('changecurrency', [ProfileController::class, 'changeCurrency'])->name('profile.currency.change');
            // add or remove to whishlist
            Route::get('add/wishlist/{product}', [ProfileController::class, 'addRemoveWishlist'])->name('profile.wishlist.add');
            Route::get('wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');

            // PGP routes
            Route::get('pgp', [ProfileController::class, 'pgp'])->name('profile.pgp');
            Route::post('pgp', [ProfileController::class, 'pgpPost'])->name('profile.pgp.post');
            Route::get('pgp/confirm', [ProfileController::class, 'pgpConfirm'])->name('profile.pgp.confirm');
            Route::post('pgp/confirm', [ProfileController::class, 'storePGP'])->name('profile.pgp.store');
            Route::get('pgp/old', [ProfileController::class, 'oldpgp'])->name('profile.pgp.old');


            Route::post('vendor/address', [ProfileController::class, 'changeAddress'])->name('profile.vendor.address'); // add address to account
            Route::get('vendor/address/remove/{id}', [ProfileController::class, 'removeAddress'])->name('profile.vendor.address.remove'); // add address to account

            // Vendor routes
            Route::get('vendor', [VendorController::class, 'vendor'])->name('profile.vendor');

            Route::get('vendor/settings', [VendorController::class, 'vendorSettings'])->name('profile.vendor.settings');
            Route::get('vendor/listed', [VendorController::class, 'vendorListedItem'])->name('profile.vendor.listeditem');
            Route::get('vendor/orders', [VendorController::class, 'vendorReceivedOrders'])->name('profile.vendor.receivedorders');
            Route::get('vendor/add', [VendorController::class, 'vendorAddItem'])->name('profile.vendor.additem');

            Route::post('vendor/set-avatar', [VendorController::class, 'editAvatar'])->name('vendor.avatar.post');
            Route::post('vendor/set-background', [VendorController::class, 'editBackground'])->name('vendor.background.post');
            Route::patch('vendor/settings', [VendorController::class, 'editVacation'])->name('vendor.editvacation.post');


            Route::post('vendor/update/profile', [VendorController::class, 'updateVendorProfilePost'])->name('profile.vendor.update.post');
            // Product add basic info
            Route::get('vendor/product/add/{type?}', [VendorController::class, 'addBasicShow'])->name('profile.vendor.product.add');
            Route::post('vendor/product/adding/{product?}', [VendorController::class, 'addShow'])->name('profile.vendor.product.add.post');
            // Add remove offers
            Route::get('vendor/product/offers/add', [VendorController::class, 'addOffersShow'])->name('profile.vendor.product.offers');
            Route::post('vendor/product/offers/new/{product?}', [VendorController::class, 'addOffer'])->name('profile.vendor.product.offers.add'); // add offer
            Route::get('vendor/product/offers/remove/{offer}/{product?}', [VendorController::class, 'removeOffer'])->name('profile.vendor.product.offers.remove');
            // Delivery
            Route::get('vendor/product/delivery/add', [VendorController::class, 'addDeliveryShow'])->name('profile.vendor.product.delivery');
            Route::post('vendor/product/delivery/add/{product?}', [VendorController::class, 'newShipping'])->name('profile.vendor.product.delivery.new');
            Route::post('vendor/product/delivery/options/{product?}', [VendorController::class, 'newShippingOption'])->name('profile.vendor.product.delivery.options');
            Route::get('vendor/product/delivery/remove/{index}/{product?}', [VendorController::class, 'removeShipping'])->name('profile.vendor.product.delivery.remove');
            // digital section
            Route::get('vendor/product/digital/add', [VendorController::class, 'addDigitalShow'])->name('profile.vendor.product.digital');
            Route::post('vendor/product/digital/add/{product?}', [VendorController::class, 'addDigital'])->name('profile.vendor.product.digital.post');

            // Images section
            Route::get('vendor/product/images/add', [VendorController::class, 'addImagesShow'])->name('profile.vendor.product.images');
            Route::get('vendor/product/images/remove/{id}/{product?}', [VendorController::class, 'removeImage'])->name('profile.vendor.product.images.remove');
            Route::get('vendor/product/images/default/{id}/{product?}', [VendorController::class, 'defaultImage'])->name('profile.vendor.product.images.default');
            Route::post('vendor/product/images/add/{product?}', [VendorController::class, 'addImage'])->name('profile.vendor.product.images.post'); // new image

            // New product
            Route::post('vendor/product/post', [VendorController::class, 'newProduct'])->name('profile.vendor.product.post');
            // Delete product
            Route::get('vendor/product/{id}/delete/confirmation', [VendorController::class, 'confirmProductRemove'])->name('profile.vendor.product.remove.confirm');
            Route::get('vendor/product/{id}/delete', [VendorController::class, 'removeProduct'])->name('profile.vendor.product.remove');

            // Edit Product
            Route::get('vendor/product/edit/{id}/section/{section?}', [VendorController::class, 'editProduct'])->name('profile.vendor.product.edit');

            // Sales routes
            Route::get('sales/{state?}', [VendorController::class, 'sales'])->name('profile.sales');
            Route::get('sale/{sale}', [VendorController::class, 'sale'])->name('profile.sales.single');
            //Route::get('sales/{sale}/sent/confirm', [VendorController::class, 'confirmSent'])->name('profile.sales.sent.confirm');
            Route::get('sale/{sale}/sent', [VendorController::class, 'markAsSent'])->name('profile.sales.sent');

            // Cart routes
            Route::get('cart', [ProfileController::class, 'cart'])->name('profile.cart');
            Route::post('cart/{product}/add', [ProfileController::class, 'addToCart'])->name('profile.cart.add');
            Route::post('cart/{product}/edit', [ProfileController::class, 'editToCart'])->name('profile.cart.edit');
            Route::get('cart/clear', [ProfileController::class, 'clearCart'])->name('profile.cart.clear');
            Route::get('cart/remove/{product}', [ProfileController::class, 'removeProduct'])->name('profile.cart.remove');
            Route::get('checkout', [ProfileController::class, 'checkout'])->name('profile.cart.checkout');
            Route::get('make/purchase', [ProfileController::class, 'makePurchases'])->name('profile.cart.make.purchases');

            // Purchases routes
            Route::get('purchases/{state?}', [ProfileController::class, 'purchases'])->name('profile.purchases');
            Route::get('purchases/{purchase}/message', [ProfileController::class, 'purchaseMessage'])->name('profile.purchases.message');
            Route::get('purchase/{purchase}', [ProfileController::class, 'purchase'])->name('profile.purchases.single');
            Route::get('purchase/{purchase}/delivered/confirm', [ProfileController::class, 'deliveredConfirm'])->name('profile.purchases.delivered.confirm');
            Route::get('purchase/{purchase}/delivered', [ProfileController::class, 'markAsDelivered'])->name('profile.purchases.delivered');

            // canceled for both Vendor and Buyer
            Route::get('purchase/{purchase}/canceled/confirm', [ProfileController::class, 'confirmCanceled'])->name('profile.purchases.canceled.confirm');
            Route::get('purchase/{purchase}/canceled', [ProfileController::class, 'markAsCanceled'])->name('profile.purchases.canceled');

            // Purchase - Disputes
            Route::get('purchase/{purchase}/dispute', [ProfileController::class, 'newDisputeMessageView'])->name('buyeradmin.profile.purchases.disputes.message.view');
            Route::get('vendor/{purchase}/dispute', [ProfileController::class, 'VendorDisputeMessageView'])->name('profile.purchases.disputes.message.view');
            Route::post('purchase/{purchase}/dispute', [ProfileController::class, 'makeDispute'])->name('profile.purchases.dispute');
            Route::post('purchase/dispute/{dispute}/new/message', [ProfileController::class, 'newDisputeMessage'])->name('profile.purchases.disputes.message');
            Route::post('purchase/{purchase}/dispute/resolve', [AdminController::class, 'resolveDispute'])->name('profile.purchases.disputes.resolve');

            // Purchase - Feedbacks
            Route::get('purchase/{purchase}/feedback/new', [ProfileController::class, 'leaveFeedbackView'])->name('profile.purchases.feedback.view');
            Route::post('purchase/{purchase}/feedback/new', [ProfileController::class, 'leaveFeedback'])->name('profile.purchases.feedback.new');

            /**
             * Messages
             */
            Route::middleware(['can_read_messages'])->group(function () {
                Route::get('messages/{conversation?}', [MessageController::class, 'messages'])->name('profile.messages');
                Route::post('messages/conversation/new', [MessageController::class, 'startConversation'])->name('profile.messages.conversation.post.new');
                Route::get('messages/conversations/list', [MessageController::class, 'listConversations'])->name('profile.messages.conversations.list');
                Route::post('messages/{conversation}/message/new', [MessageController::class, 'newMessage'])->name('profile.messages.message.new');
                Route::get('messages/{conversation}/sendmessage', [MessageController::class, 'newMessage'])->name('profile.messages.send.message'); // get request for redirecting from new conversation
            });
            Route::get('messages/decrypt/key', [MessageController::class, 'decryptKeyShow'])->name('profile.messages.decrypt.show');
            Route::post('messages/decrypt/key', [MessageController::class, 'decryptKeyPost'])->name('profile.messages.decrypt.post');

            Route::get('messages/conversation/new', [MessageController::class, 'startConversationView'])->name('profile.messages.conversation.new');

            /**
             * Notifications
             */
            Route::get('notifications', [NotificationController::class, 'viewNotifications'])->name('profile.notifications');
            Route::post('notifications/delete', [NotificationController::class, 'deleteNotifications'])->name('profile.notifications.delete');


            /**
             * Tickets
             */
            Route::get('tickets/{ticket?}', [ProfileController::class, 'tickets'])->name('profile.tickets');
            Route::post('tickets/new', [ProfileController::class, 'newTicket'])->name('profile.tickets.new');
            Route::post('tickets/{ticket}/newmessage', [ProfileController::class, 'newTicketMessage'])->name('profile.tickets.message.new');

            /**
             * Product clone
             */
            //Route::get('product/clone/{product}', [ProductController::class, 'cloneProductShow'])->name('profile.vendor.product.clone.show');
            // Route::get('product/clone/{product}', [ProductController::class, 'cloneProductPost'])->name('profile.vendor.product.clone.post');

        });
    });
});

Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/list/{user:username}/products/', [IndexController::class, 'homeWithVendor'])->name('home.with.vendor');
Route::post('theme', [IndexController::class, 'themeSwitch'])->name('theme.switch.post');
Route::get('/category/{category}', [IndexController::class, 'category'])->name('category.show');

Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/confirmation', [IndexController::class, 'confirmation'])->name('confirmation');

Route::get('setview/{list}', [IndexController::class, 'setView'])->name('setview');

// Product routes
Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('product/{product}/rules', [ProductController::class, 'showRules'])->name('product.rules');
Route::get('product/{product}/feedback', [ProductController::class, 'showFeedback'])->name('product.feedback');
Route::get('product/{product}/delivery', [ProductController::class, 'showDelivery'])->name('product.delivery');
Route::get('product/{product}/vendor', [ProductController::class, 'showVendor'])->name('product.vendor');

// vendor routes
Route::get('vendor/{user:username}', [IndexController::class, 'vendor'])->name('vendor.show');
Route::get('user/{user:username}', [IndexController::class, 'userProfile'])->name('user.show');

Route::get('vendor/{user}/feedback', [IndexController::class, 'vendorsFeedbacks'])->name('vendor.show.feedback');

//Route::post('search', [SearchController::class, 'search'])->name('search');
//Route::get('search', [SearchController::class, 'searchShow'])->name('search.show');
