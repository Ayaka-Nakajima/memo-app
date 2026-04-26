<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MemoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Memo::latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $memo = Memo::create($validated);

        return response()->json($memo, 201);
    }

    public function show(Memo $memo): JsonResponse
    {
        return response()->json($memo);
    }

    public function update(Request $request, Memo $memo): JsonResponse
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $memo->update($validated);

        return response()->json($memo);
    }

    public function destroy(Memo $memo): JsonResponse
    {
        $memo->delete();

        return response()->json(null, 204);
    }
}
