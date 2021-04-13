<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
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
            'name' => 'required|string|min:6',
            'phone' => 'required|string|min:10',
            'message' => 'required|string|min:10',
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

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'data' => $request->all()
        ],
            Response::HTTP_CREATED
        );
    }
}
