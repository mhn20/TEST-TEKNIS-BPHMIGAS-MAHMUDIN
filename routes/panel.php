<?php

    use App\Http\Controllers\Panel\AuthController;
    use App\Http\Controllers\Panel\DashboardController;
    use App\Http\Controllers\Panel\DataWebsiteController;
    use App\Http\Controllers\Panel\SlidersController;
    use App\Http\Controllers\Panel\ArticlesController;
    use App\Http\Controllers\Panel\VideosController;
    use App\Http\Controllers\Panel\ContactsController;
    use App\Http\Controllers\Panel\MyProfileController;
    use App\Http\Controllers\Panel\EditProfileController;
    use App\Http\Controllers\Panel\UsersController;
    use App\Http\Controllers\Panel\DocumentContractController;
    use App\Http\Controllers\Panel\AssetController;
    use App\Http\Controllers\Panel\PendapatanController;
    use App\Http\Controllers\Panel\SettingsPendapatanController;
    use App\Http\Controllers\Panel\BarangController;
    use App\Http\Controllers\Panel\InvoiceController;

    Route::group(['prefix' => 'panel'], function () {
        Route::get('/register/',[AuthController::class,'register'])->name('panel.register');
        Route::post('/register/proses/',[AuthController::class,'prosesRegister'])->name('panel.register.proses');
        Route::post('/update-isverif/',[AuthController::class,'updateIsverif'])->name('panel.updateIsverif');
        Route::post('/resend-aktivasi/',[AuthController::class,'resendAktivasi'])->name('panel.resendAktivasi');
        Route::post('/send-forgot-password/',[AuthController::class,'sendForgotPassword'])->name('panel.sendForgotPassword');
        Route::get('/confirm-forgot-password/',[AuthController::class,'confirmForgotPassword'])->name('panel.confirmForgotPassword');
        Route::post('/change-password/',[AuthController::class,'changePassword'])->name('panel.changePassword');
        Route::get('/login/',[AuthController::class,'login'])->name('panel.login');
        Route::post('/login/proses/',[AuthController::class,'prosesLogin'])->name('panel.proses');
    });

    Route::group(['prefix' => 'panel', 'middleware' => 'AuthPanel'], function () {
        Route::get('/dashboard/',[DashboardController::class,'index'])->name('panel.dashboard');

        Route::get('/data-website/',[DataWebsiteController::class,'index'])->name('panel.datawebsite');
        Route::post('/data-website/update/',[DataWebsiteController::class,'update'])->name('panel.datawebsite.update');

        Route::get('/settings-pendapatan/',[SettingsPendapatanController::class,'index'])->name('panel.settings_pendapatan');
        Route::post('/settings-pendapatan/update/',[SettingsPendapatanController::class,'update'])->name('panel.settings_pendapatan.update');

        Route::get('/edit-profile/',[EditProfileController::class,'index'])->name('panel.editprofile');
        Route::post('/edit-profile/update/',[EditProfileController::class,'update'])->name('panel.editprofile.update');

        Route::get('/myprofile/',[MyProfileController::class,'index'])->name('panel.myprofile');
        Route::post('/myprofile/update/',[MyProfileController::class,'update'])->name('panel.myprofile.update');
        Route::get('/myprofile/download/',[MyProfileController::class,'download'])->name('panel.myprofile.download');
        Route::get('/myprofile/label-status-verif/',[MyProfileController::class,'labelStatusVerif'])->name('panel.myprofile.labelStatusVerif');
        Route::post('/myprofile/proses-bantuan/',[MyProfileController::class,'prosesBantuan'])->name('panel.myprofile.prosesBantuan');

        Route::get('/sliders/',[SlidersController::class,'index'])->name('panel.sliders');
        Route::get('/sliders/data/',[SlidersController::class,'data'])->name('panel.sliders.data');
        Route::post('/sliders/post-data/',[SlidersController::class,'postData'])->name('panel.sliders.postData');
        Route::put('/sliders/edit-data/{id}', [SlidersController::class,'editData'])->name('panel.sliders.editData');
        Route::delete('/sliders/delete-data/{id}', [SlidersController::class,'deleteData'])->name('panel.sliders.deleteData');

        Route::get('/articles/',[ArticlesController::class,'index'])->name('panel.articles');
        Route::get('/articles/data/',[ArticlesController::class,'data'])->name('panel.articles.data');
        Route::post('/articles/post-data/',[ArticlesController::class,'postData'])->name('panel.articles.postData');
        Route::get('/articles/get-content/{id}', [ArticlesController::class,'getContent'])->name('panel.articles.getContent');
        Route::put('/articles/edit-data/{id}', [ArticlesController::class,'editData'])->name('panel.articles.editData');
        Route::delete('/articles/delete-data/{id}', [ArticlesController::class,'deleteData'])->name('panel.articles.deleteData');

        Route::get('/users/',[UsersController::class,'index'])->name('panel.users');
        Route::post('/users/post-data/',[UsersController::class,'postData'])->name('panel.users.postData');
        Route::get('/users/data/',[UsersController::class,'data'])->name('panel.users.data');
        Route::put('/users/update-verifikasi/',[UsersController::class,'updateVerifikasi'])->name('panel.users.updateVerifikasi');
        Route::post('/users/update-pragita-composer-id/{id}',[UsersController::class,'updatePragitaComposerID'])->name('panel.users.updatePragitaComposerID');
        Route::delete('/users/delete-data/{id}',[UsersController::class,'deleteData'])->name('panel.users.deleteData');
        Route::put('/users/update-data/{id}',[UsersController::class,'updateData'])->name('panel.users.updateData');

        Route::get('/pendapatan/',[PendapatanController::class,'index'])->name('panel.pendapatan');
        Route::get('/pendapatan/data-perbulan/',[PendapatanController::class,'dataPerbulan'])->name('panel.pendapatan.dataPerbulan');
        Route::get('/pendapatan/data-percomposer/',[PendapatanController::class,'dataPerComposer'])->name('panel.pendapatan.dataPerComposer');
        Route::get('/pendapatan/data-detailcomposer/',[PendapatanController::class,'dataDetailComposer'])->name('panel.pendapatan.dataDetailComposer');
        Route::post('/pendapatan/postdata/',[PendapatanController::class,'postData'])->name('panel.pendapatan.postData');
        Route::put('/pendapatan/update-percent/{id}',[PendapatanController::class,'updatePercent'])->name('panel.pendapatan.updatePercent');
        Route::delete('/pendapatan/deletedata/{id}',[PendapatanController::class,'deleteData'])->name('panel.pendapatan.deleteData');
        Route::put('/pendapatan/upload-dokumen-pph23/{id}',[PendapatanController::class,'uploadDokumenPPH23'])->name('panel.pendapatan.uploadDokumenPPH23');
        Route::post('/pendapatan/upload-csv/',[PendapatanController::class,'uploadCSV'])->name('panel.pendapatan.uploadCSV');

        Route::get('/document-contract/',[DocumentContractController::class,'index'])->name('panel.document-contract');
        Route::get('/document-contract/data/',[DocumentContractController::class,'data'])->name('panel.document-contract.data');
        Route::get('/document-contract/get-data-users/',[DocumentContractController::class,'getDataUsers'])->name('panel.document-contract.getDataUsers');
        Route::post('/document-contract/post-data/',[DocumentContractController::class,'postData'])->name('panel.document-contract.postData');
        Route::get('/document-contract/get-content/{id}', [DocumentContractController::class,'getContent'])->name('panel.document-contract.getContent');
        Route::put('/document-contract/edit-data/{id}', [DocumentContractController::class,'editData'])->name('panel.document-contract.editData');
        Route::delete('/document-contract/delete-data/{id}', [DocumentContractController::class,'deleteData'])->name('panel.document-contract.deleteData');

        Route::get('/asset/',[AssetController::class,'index'])->name('panel.asset');
        Route::get('/asset/data/',[AssetController::class,'data'])->name('panel.asset.data');
        Route::post('/asset/post-data/',[AssetController::class,'postData'])->name('panel.asset.postData');
        Route::get('/asset/get-content/{id}', [AssetController::class,'getContent'])->name('panel.asset.getContent');
        Route::put('/asset/edit-data/{id}', [AssetController::class,'editData'])->name('panel.asset.editData');
        Route::delete('/asset/delete-data/{id}', [AssetController::class,'deleteData'])->name('panel.asset.deleteData');
        Route::post('/users/update-pragita-asset-id/{id}',[AssetController::class,'updatePragitaAssetID'])->name('panel.asset.updatePragitaAssetID');

        Route::get('/videos/',[VideosController::class,'index'])->name('panel.videos');
        Route::get('/videos/data/',[VideosController::class,'data'])->name('panel.videos.data');
        Route::post('/videos/post-data/',[VideosController::class,'postData'])->name('panel.videos.postData');
        Route::put('/videos/edit-data/{id}', [VideosController::class,'editData'])->name('panel.videos.editData');
        Route::delete('/videos/delete-data/{id}', [VideosController::class,'deleteData'])->name('panel.videos.deleteData');

        Route::get('/contacts/',[ContactsController::class,'index'])->name('panel.contacts');
        Route::get('/contacts/data/',[ContactsController::class,'data'])->name('panel.contacts.data');
        Route::delete('/contacts/delete-data/{id}', [ContactsController::class,'deleteData'])->name('panel.contacts.deleteData');

        Route::get('/barang', [BarangController::class,'index'])->name('panel.barang');
        Route::get('/barang/data', [BarangController::class,'data'])->name('panel.barang.data');
        Route::post('/barang/post-data', [BarangController::class,'postData'])->name('panel.barang.postData');
        Route::post('/barang/post-upload-excel', [BarangController::class,'uploadDataExcel'])->name('panel.barang.uploadDataExcel');
        Route::put('/barang/edit-data/{id}', [BarangController::class,'editData'])->name('panel.barang.editData');
        Route::delete('/barang/delete-data/{id}', [BarangController::class,'deleteData'])->name('panel.barang.deleteData');


        Route::get('/invoice', [InvoiceController::class,'index'])->name('panel.invoice');
        Route::get('/invoice/data', [InvoiceController::class,'data'])->name('panel.invoice.data');
        Route::put('/invoice/verifikasi/{id}', [InvoiceController::class,'verifikasi'])->name('panel.invoice.verifikasi');
        
        Route::get('/logout/',[AuthController::class,'logout'])->name('panel.logout');
    });
    
    Route::put('/invoice/bukti-transfer/{id}', [InvoiceController::class,'uploadBuktiTransfer'])->name('panel.invoice.uploadBuktiTransfer');
    Route::get('/invoice/detail/{id}', [InvoiceController::class,'detailInvoice'])->name('panel.invoice.detailInvoice');
