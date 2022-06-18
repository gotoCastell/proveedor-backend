<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileReadController extends Controller
{
    public function FileReadPlainText($url, $delimiter){
        $file = fopen($url, 'r');
        
        if(!$file){
            return [
                'request' => false,
                'error'=> 'Error en el archivo'
            ];
        }

        $lines = [];
        while(!feof($file)){
            $data = explode($delimiter,fgets($file));
            $lines[] = [
                'name' => $this->clean(isset($data[0]) ? $data[0] : ''),
                'email' => $this->clean(isset($data[1]) ? $data[1] : ''),
                'RFC' => $this->clean(isset($data[2]) ? $data[2] : '')
            ]; 
        }
        fclose($file);

        return [
                'request' => true,
                'data' => $lines
            ];
    }

    private function clean($string){
        return ltrim(rtrim($string));
    }
}