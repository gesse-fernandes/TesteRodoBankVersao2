<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//TODO aqui eu crio uma unica rota resource
//TODO pois ela serve para simplificar
//TODO as outras rotas assim não criando
//TODO na mão ja fica como referencia
//TODO todos os metodos deste controller(index,store,show,update e destroy)

Route::resource('freight', 'Api\FreightController');
