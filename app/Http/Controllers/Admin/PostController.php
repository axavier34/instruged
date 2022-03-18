<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        $search = request('search');

        if($search){
            
            $posts = Post::where('name','like', '%'.$search.'%')
            ->orWhere('cpf', 'like', '%'.$search.'%')
            ->orWhere('post', 'like', '%'.$search.'%')
            ->orWhere('author', 'like', '%'.$search.'%')
            ->orWhere('departamento', 'like', '%'.$search.'%')
            ->orderBy('name')
            ->paginate(100);
        }
        else{

            $posts = Post::paginate(10);
        }
        $loggedId= intval(Auth::id());
        
        return view('admin.post.index',[
            'posts' => $posts,
            'search' => $search,
            'loggedId' => $loggedId
        ]);
    }
    public function indexdoc(Request $request)
    {
        
        
        $searchdoc = request('searchdoc');

        if($searchdoc){
            
            $posts = Post::where('post', 'like', '%'.$searchdoc.'%')
            ->orWhere('departamento', 'like', '%'.$searchdoc.'%')
            ->orderBy('departamento')
            ->paginate(100);
        }
        else{

            $posts = Post::paginate(10);
        }
        $loggedId= intval(Auth::id());
        // if($request->has('')){

        //     $image = Image::where("post_id", $posts->id)->get();
        // }
        return view('admin.post.indexdoc',[
            'posts' => $posts,
            'search' => $searchdoc,
            'loggedId' => $loggedId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deptos = Departamento::where('ativo', '0')->get();
        return view('admin.post.create',['deptos'=>$deptos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(
            'name',
            'cpf',
            'departamento',
            'post',
            'data_file',
            'author',
            'file_path',
        );
        $validate = Validator::make($data,[
            'name'                  => ['required', 'string', 'max:255'],
            'cpf'                   => ['required', 'string', 'max:18'],
            'departamento'          => ['required'],
            'data_file'             => ['required'],
            'file_path'             => ['required','max:2048'],
       ]);
       if($validate->fails()){
        return redirect()->route('posts.create')->with('error','Preencha o(s) campo(s) corretamente para poder continuar com seu cadastro.')
            ->withErrors($validate);
        }
       else {
            $depto = $data['departamento'];
            $post = new Post;
            $post->name = $data['name'];
            $post->cpf = $data['cpf'];
            $post->author = $data['author'];
            $post->post = $data['post'];
            $post->data_file = $data['data_file'];
            $post->departamento = $data['departamento'];
            $post->save();
            // Handle File Upload
            if($request->hasFile('file_path')){
                $files = $request->file('file_path');
                foreach($files as $file){
                    // Get filename with the extension
                    $filenameWithExt = $file->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    // $extension = $files->getClientOriginalExtension();'.$extension
                    // Filename to store
                    $fileNameToStore= $filename.'_'.$depto.'_'.time();

                    $request['post_id'] = $post->id;
                    $request['image'] = $fileNameToStore;

                    $file->move(\public_path("/files"),$fileNameToStore);

                    Image::create($request->all());
                }

            } else {
                $fileNameToStore = 'noimage.png';
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts=Post::findOrFail($id);
        $loggedId= intval(Auth::id());
        $user = User::find($id);
        // $img = Image::findOrFail($posts->id);
        return view('admin.post.edit',[
            'posts' => $posts,
            'loggedId' => $loggedId,
            'user' => $user
            // 'files' => $img
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Post $post)
    {
        $post = Post::findOrFail($id);
        if($post){

            $data = $request->only(
                'name',
                'cpf',
                'departamento',
                'post',
                'author',
                'file_path',
            );
            $validate = Validator::make($data,[
                'name'                  => ['required', 'string', 'max:255'],
                'cpf'                   => ['required', 'string', 'max:14'],
                'departamento'          => ['required'],
                'file_path'             => ['required','max:2048'],
           ]);
           if($validate->fails()){
            return redirect()->route('posts.create')->with('error','Preencha o(s) campo(s) corretamente para poder continuar com seu cadastro.')
                ->withErrors($validate);
            }
            else {
                $depto = $data['departamento'];
                $post = new Post;
                $post->name = $data['name'];
                $post->cpf = $data['cpf'];
                $post->author = $data['author'];
                $post->post = $data['post'];
                $post->departamento = $data['departamento'];
                $post->save();
                // Handle File Upload
                if($request->hasFile('file_path')){
                    $files = $request->file('file_path');
                    foreach($files as $file){
                        // Get filename with the extension
                        $filenameWithExt = $file->getClientOriginalName();
                        // Get just filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        // Get just ext
                        // $extension = $files->getClientOriginalExtension();'.$extension
                        // Filename to store
                        $fileNameToStore= $filename.'_'.$depto.'_'.time();
    
                        $request['post_id'] = $post->id;
                        $request['image'] = $fileNameToStore;
    
                        $file->move(\public_path("/files"),$fileNameToStore);
    
                        Image::create($request->all());
                    }
    
                } else {
                    $fileNameToStore = 'noimage.png';
                }
         }
        }
        
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::findorFail($id);
        $images= Image::where("post_id", $posts->id)->get();
        foreach($images as $image){
            if(File::exists("files/".$image)){
                File::delete("files/".$image);
            }
        }
        $posts->delete();

        return back();
    }
    public function deletefile(Request $request, $id){
        $images = Image::findOrFail($id);
        if(File::exists(public_path("files/$images->image"))){
            File::delete(public_path("files/$images->image"));
        }else{
            dd('File does not exists.');
        }
        
    }
}
