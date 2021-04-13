<?php


namespace App\Services\Factory;


interface IStoreFactory
{
    public static function createStore(string $className): IStore;
}
