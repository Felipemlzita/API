<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserFields;
use App\Models\UserFields AS ModelsUserFields;
use App\Models\SystemVariable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIAgro extends Controller
{

    private $apiKey;
    private $endPoint;

    public function __construct()
    {
        $this->apiKey = "2999f7449040cca44c28387d2f87a2e7";
        $this->endPoint = "http://api.agromonitoring.com/agro/1.0";
    }

    // Lista Todos os campos registrados na Chave de API
    public function listarCampo()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->endPoint.'/polygons?appid='.$this->apiKey,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    // Cadastrar campo
    public function cadastroCampo($name, $polygon)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->endPoint.'/polygons?appid='.$this->apiKey,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "name":"'.$name.'",
          "geo_json":{
              "type":"Feature",
              "properties":{

              },
              "geometry":{
                "type":"Polygon",
                "coordinates":[
                  '.$polygon.'
                ]
              }
          }
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
