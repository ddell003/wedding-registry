<?php

namespace App;


use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class Obfuscator
 * @package App
 * @library https://github.com/vinkla/laravel-hashids
 */
class Obfuscator
{

    protected $excludeFields = [];
    protected $result;
    private $obfuscation_map = [];

    public function encodeAndMemorize($value)
    {
        if (!array_key_exists($value, $this->obfuscation_map)) {
            $this->obfuscation_map[$value] = self::encode($value);
        }
        return $this->obfuscation_map[$value];
    }

    public function decodeAndMemorize($value)
    {
        if (!in_array($value, $this->obfuscation_map)) {
            $decoded = self::decode($value);
            $this->obfuscation_map[$decoded] = $value;
        }
        return array_flip($this->obfuscation_map)[$value];
    }

    public static function encode($value)
    {
        return Hashids::encode($value);
    }

    public static function decode($value, $statusCode = 422)
    {
        try{
            $array = Hashids::decode($value);
            return $array[0];
        }catch(\ErrorException $exception){

            if($statusCode == 404){
                throw new NotFoundHttpException('Resource Not Found');
            }
            throw new UnprocessableEntityHttpException('Incorrect Id Provided: ' . $value . ' (' . $exception->getMessage() . ')');
        }
    }

    public static function forceDecode($value)
    {
        //decode without error catching
        $array = Hashids::decode($value);
        return $array[0];

    }

    public static function decodeWithoutError($value)
    {
        //decode without error catching
        $array = Hashids::decode($value);
        return Arr::get($array,0);

    }
}
