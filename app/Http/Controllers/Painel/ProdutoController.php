<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;
use App\Http\Requests\Painel\ProductFormRequest;
class ProdutoController extends Controller
{
    private $product;
    private $totalPage = 6;
    public function _contruct(Product $product)
    {
      $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        //$product = new Product();
        $title = 'Listagem Dos Produtos';
        $products = $product->paginate($this->totalPage);
        return view('painel.products.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar novo produto";
        $categorys=['eletronicos', 'moveis', 'limpeza', 'banho'];
        return view('painel.products.create-edit', compact('title', 'categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request, Product $product)
    {
        //dd($request->all());
        //dd($request->only('name', 'number'));
        //dd($request->except('_token'));
        //dd($request->input('name'));
        //peça todos os dados que vem do formulario
        $dataForm = $request->all();

        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;
        //validar dados
        //$this->validate($request, $product->rules);
        /*
        $messages = ;
        $validate = validator($dataForm, $product->rules, $messages);
        if($validate->fails() ) {
          return redirect()
                    ->route('produtos.create')
                    ->withErrors($validate)
                    ->withInput();
        }
        */

        //faz o Cadastro
        $insert = $product->create($dataForm);
        if($insert)
          return redirect()->route('produtos.index');

        else
          return redirect()->route('produtos.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Product $product)
    {
        $product = $product->find($id);
        $title = "Product: {$product->name}";
        return view('painel.products.show', compact('product', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Product $product)
    {
        // recupera o produto pelo id
        $product = $product->find($id);
        $title = "Editar Produto: {$product->name}";
        $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho'];
        return view('painel.products.create-edit', compact('product', 'title', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id, Product $product)
    {
        //recupera todos os dados do formulario
        $dataForm= $request->all();

        //recupera o item para editar
        $product = $product->find($id);

        //verifica se o produto esta ativado
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;

        //altera os itens
        $update = $product->update($dataForm);

        //verifica se realmente editou
        if($update)
          return redirect()->route('produtos.index');
        else
          return redirect()->route('produtos.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Product $product)
    {
      $prod = $product->find($id);
      $delete = $prod->delete();
      if($delete)
        return redirect()->route('produtos.index');
      else
        return redirect()->route('produtos.show', $id)->with(['errors' => 'Falha ao deletar']);
    }

    public function tests(Product $product)
    { /*
      $prod = $product->find(5);
      $prod->name    = 'Update';
      $prod->number = '78873';
      $prod->active = true;
      $prod->category = 'eletronicos';
      $prod->description = 'Desc Update';
      $update = $prod->save();
      if($update)
        return "alterado com sucesso";
      else
        return 'Falha ao alterar';
      */
      /*
      $prod = $product->find(6);
      $update = $prod->update([
          'name'        => 'Update do Produto',
          'number'      => 333333,
          'active'      => true,
      ]);
      if($update)
        return "Alterado com sucesso";
      else
        return 'Falha ao alterar';
      */
      /*
        $insert = $product->create([
            'name'        => 'Nome do Produto',
            'number'      => 4344735,
            'active'      => false,
            'category'    => 'eletronicos',
            'description' => 'Descrição vem aqui'
        ]);
        if($insert)
          return "inserido com sucesso, ID: {$insert->id}";
        else
          return 'Falha ao inserir';*/
        /*
        //alterar por numero do produto
        $update = $product
            ->where('number', 4344735)
            ->update([
                  'name'        => 'NOVO UPDATE',
                  'number'      => 6666666,
                  'active'      => false,
                ]);
        if($update)
          return "Alterado com sucesso";
        else
          return 'Falha ao alterar';
        */
        /*
        $prod = $product->find();
        $delete = $prod->delete();
        if($delete)
          return "Deletado com sucesso";
        else
          return 'Falha ao deletar';
        */
        $delete = $product
            ->where('number', 6666666)
            ->delete();
        if($delete)
          return "Deletado com sucesso";
        else
          return 'Falha ao deletar';
    }
}
