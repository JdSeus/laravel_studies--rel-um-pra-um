<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Models\Cliente;
use App\Models\Endereco;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach($clientes as $c) {
        echo "<p>ID: " . $c->id . "</p>";
        echo "<p>Nome: " . $c->nome . "</p>";
        echo "<p>Telefone: " . $c->telefone . "</p>";
        //$e = Endereco::where('cliente_id', $c->id)->first();

        echo "<p>Rua : " . $c->endereco->rua . "</p>";
        echo "<p>Numero : " . $c->endereco->numero . "</p>";
        echo "<p>Bairro : " . $c->endereco->bairro . "</p>";
        echo "<p>Cidade : " . $c->endereco->cidade . "</p>";
        echo "<p>Uf : " . $c->endereco->uf . "</p>";
        echo "<p>Cep : " . $c->endereco->cep . "</p>";
        echo "<br>";
    }
});

Route::get('/enderecos', function () {
    $ends = Endereco::all();
    foreach($ends as $e) {
        echo "<p>ID Cliente: " . $e->cliente_id . "</p>";
        
        echo "<p>Nome: " . $e->cliente->nome . "</p>";
        echo "<p>Telefone: " . $e->cliente->telefone . "</p>";

        echo "<p>Rua : " . $e->rua . "</p>";
        echo "<p>Numero : " . $e->numero . "</p>";
        echo "<p>Bairro : " . $e->bairro . "</p>";
        echo "<p>Cidade : " . $e->cidade . "</p>";
        echo "<p>Uf : " . $e->uf . "</p>";
        echo "<p>Cep : " . $e->cep . "</p>";

    }
});

Route::get('/inserir', function() {
    $c = new Cliente();
    $c->nome = "Jose Almeira";
    $c->telefone = "11 97878-787";
    $c->save();

    $e = new Endereco();
    $e->rua = "Av. do Estado";
    $e->numero = 400;
    $e->bairro = "Centro";
    $e->cidade = "São Paulo";
    $e->uf = "SP";
    $e->cep = "13010-456";
    
    $c->endereco()->save($e);



    $c = new Cliente();
    $c->nome = "Marcos Silva";
    $c->telefone = "12 97878-787";
    $c->save();

    $e = new Endereco();
    $e->rua = "Av. do Brasil";
    $e->numero = 1500;
    $e->bairro = "Jardim Olivia";
    $e->cidade = "São Paulo";
    $e->uf = "SP";
    $e->cep = "130321-436";
    
    $c->endereco()->save($e);
});

Route::get('/clientes/json', function() {
    //$clientes = Cliente::all();
    $clientes = Cliente::with(['endereco'])->get();
    return $clientes->toJson();
});

Route::get('/enderecos/json', function() {
    //$enderecos = Cliente::all();
    $enderecos = Endereco::with(['cliente'])->get();
    return $enderecos->toJson();
});


