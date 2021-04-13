<?php


namespace App\Services\Factory;


use Illuminate\Support\Facades\Storage;

class JsonFile implements IStore
{
    /**
     * @var string
     */
    private $pathToFile = 'test.json';

    public function save(Feedback $feedback): void
    {
        $storage = Storage::disk('public');
        $data = [];
        $data[] = $feedback->toArray();
        if ($storage->exists('feedback/feedback.json')) {
            $data = json_decode($storage->get('feedback/feedback.json'), true);
            $data[] = $feedback->toArray();
        }
        $storage->put('feedback/feedback.json', json_encode($data));
    }
}
