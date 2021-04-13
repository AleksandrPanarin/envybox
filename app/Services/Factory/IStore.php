<?php


namespace App\Services\Factory;


interface IStore
{
    public function save(Feedback $feedback): void;
}
