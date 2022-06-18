<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{

   protected function successResponse($data, $code = Response::HTTP_OK ){
      return response()->json($data, $code);
   }
   
   protected function errorResponse($message, $code){
      return response()->json(['errors'=>$message, 'code'=>$code], $code);
   }

   protected function showAll(Collection $collection, $code = Response::HTTP_OK){
      return $this->successResponse(['data'=>$collection], $code);
   }
   
   protected function showOne(Model $instance, $code = Response::HTTP_OK ){
      return $this->successResponse(['data'=>$instance], $code);
   }
}