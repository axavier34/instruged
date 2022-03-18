<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        // $this->middleware('can:edit-users');
    }

    public function index(){
        $search = request('search');

        if($search){
            $deptos = Departamento::where('name','like', '%'.$search.'%')
            ->orWhere('cpf', 'like', '%'.$search.'%')
            ->orWhere('descricao', 'like', '%'.$search.'%')
            ->orWhere('dt_cadastro', 'like', '%'.$search.'%')
            ->orWhere('departamento', 'like', '%'.$search.'%')
            ->orderBy('name')
            ->paginate(1);
        }
        else{

            $deptos = Departamento::paginate(10);
        }
        $loggedId= intval(Auth::id());
        return view('admin.departamentos.index', [
            'deptos' => $deptos,
            'search' => $search,
            'loggedId' => $loggedId
        ]);
    }

    public function create(){
        return view('admin.departamentos.create');
    }

    public function store(Request $request) {
        $data = $request->only(
            'departamento'
           
        );
        $validate = Validator::make($data,[
            'departamento'                  => ['required', 'string', 'max:255']
        ]);
        if($validate->fails()){
            return redirect()->route('posts.create')->with('error','Preencha o(s) campo(s) corretamente para poder continuar com seu cadastro.')
                ->withErrors($validate);
            }
            else {
                 $depto= new Departamento();
                 $depto->departamento = strtoupper($data['departamento']);
                 $depto->ativo = 0;
                 $depto->save();
            }        
            return redirect()->route('departamentos.index')->with('message','Cadastro realizado com sucesso!');
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $depto = Departamento::findOrFail($id);
       return view('admin.departamentos.edit',[
           'depto' =>$depto
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggedId= intval(Auth::id());
        if($loggedId !== intval($id)){
            $depto = Departamento::find($id);
            $depto->delete();
        }
        return redirect()->route('departamentos.index');
    }
}
