<?php


namespace App\Services\Factory;


class StoreFactory implements IStoreFactory
{
    private static $stores = [
        MysqlDatabase::class,
        JsonFile::class,
    ];

    public static function createStore(string $className): IStore
    {
        if (in_array($className, self::$stores)) {
            return new $className;
        }
        throw new \Exception('Store not found');
    }
}
