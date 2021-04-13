<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Factory\Feedback;
use App\Services\Factory\JsonFile;
use App\Services\Factory\MysqlDatabase;
use App\Services\Factory\StoreFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validator = $this->getValidationFactory()->make($request->all(), [
            'name' => 'required|string|min:1',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $bag = $validator->getMessageBag();
            $errorMessages = [];
            if ($bag->getMessages()) {
                foreach ($bag->getMessages() as $key => $item) {
                    $errorMessages[$key] = implode(' | ', $item);
                }
            }
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'errors' => $errorMessages
            ], Response::HTTP_BAD_REQUEST);
        }
        $data = $request->all();
        $feedback = (new Feedback())
            ->setName($data['name'])
            ->setPhone($data['phone'])
            ->setMessage($data['message']);

        StoreFactory::createStore(MysqlDatabase::class)->save($feedback);
        StoreFactory::createStore(JsonFile::class)->save($feedback);

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'data' => $request->all()
        ],
            Response::HTTP_CREATED
        );
    }
}
