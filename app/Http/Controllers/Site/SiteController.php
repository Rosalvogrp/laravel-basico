<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\controller;

class SiteController extends Controller
{
    public function __construct(){
      //$this->middleware('auth');
      /*
      $this->middleware('auth')
              -> only([
                'contato',
                'categoria'
              ]);*/
      $this->middleware('auth')
                    ->except([
                        'index',
                        'contato'
                    ]);
    }
    public function index(){
      $title = 'INICIO';
      $xss = "<script>alert('Ataque XSS')</script>";

      $var1 = '123';

      $arrayData =[];
      return view('site.home.index', compact('title','xss', 'var1', 'arrayData'));
    }

    public function contato(){
      return view('site.contato.index');
    }

    public function categoria($id){
      return "Listagem dos posts da categoria: $id";
    }

    public function categoriaop($id = 1){
      return "Listagem dos posts da categoria: $id";
    }
}
