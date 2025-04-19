<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (): array {
    return ['Laravel' => app()->version()];
});
