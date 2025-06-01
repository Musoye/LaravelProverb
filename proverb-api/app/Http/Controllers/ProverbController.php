<?php

namespace App\Http\Controllers;

use App\Models\Proverb;
use App\Http\Resources\ProverbResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProverbController extends Controller
{

    public function index()
    {
        $proverbs =  Proverb::get();
        if ($proverbs->count() > 0){
            return ProverbResource::collection($proverbs);
        } else {
            return response()->json([ 'message' => 'No record available'], 200);
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response->json([
                'message' => 'Error in creating object',
                'errors' => validator->messages()
            ], 422);
        };

        $product = Proverb::create([
            'name' => $request->name,
            'content' => $request->content
        ]);

        return response()->json([
            'message' => 'New Proverb Created',
            'data' => new ProverbResource($product)
        ], 201);

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Proverb $proverb)
    {
        return new ProverbResource($proverb);
        //
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Proverb $proverb)
  {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error in updating object',
                'errors' => $validator->messages()
            ], 422);
        }

        $proverb->update([
            'name' => $request->name,
            'content' => $request->content
        ]);

        return response()->json([
            'message' => 'Proverb Updated Successfully',
            'data' => new ProverbResource($proverb)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proverb $proverb)
    {
        $proverb->delete();
        return response()->json ([
            'message' => 'Proverb Deleted Successfully'
        ]);
        //
    }
}
