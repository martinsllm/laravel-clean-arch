<?php

use App\Jobs\Book\ConvertBookJob;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    ConvertBookJob::dispatchSync('188e831e-0335-4bc9-9deb-c4d6dba6b258');

    return view('welcome');
});
