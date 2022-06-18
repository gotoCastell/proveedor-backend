<?php

namespace App\Http\Controllers\Provider;

use App\Models\User;
use App\Models\Provider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Http\Controllers\Provider\FileReadController;


class ProviderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return $this->successResponse($providers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // 
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProviderRequest $request)
    {
        // aqui se podria condicinar para el tipo de archivo y el delimitador
        // solo lo hice para archivos .txt, tambien pudiera usar laravel-excel
        // pero no lo implemente en este ejemplo 
        
        $file = new FileReadController;
        $data = $file->fileReadPlaintext($request->file, '|');

        $listAdd = array();

        if($data['request']){
            foreach ($data['data'] as &$valor) {
                $validator = Validator::make($valor, [
                    'name' => ['required'],
                    'email' => ['required','email'],
                    'RFC' => ['required'],
                ]);
                if(!$validator->fails()){
                    $provider = Provider::firstOrCreate($valor);
                    array_push($listAdd, $provider);
                };
            }

        }

        if(count($listAdd)){
            return $this->successResponse($listAdd );
        }
        return $this->errorResponse([
            'list' => 'Error en datos de proveedores'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProviderRequest  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        //aqui mismo agrege la logica para insertar los proveedores a la tabla users 
        //aunque no es una buena ida hacelo asi
        $user = User::where('email' , $provider->email)->first();

        $provider->confirmed = $request->confirmed;
        $provider->save();

        if($user){
            $user->delete();
        }else{
            User::create([
                "name"=> $provider->name,
                "email"=> $provider->email,
                "password"=> Hash::make($provider->RFC),
            ]);
        }
        return $this->showOne($provider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}