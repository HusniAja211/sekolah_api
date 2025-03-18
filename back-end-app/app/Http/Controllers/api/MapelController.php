<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $mapel = Mapel::all();
            return response()->json([
                'success' => true,
                'message' => 'Data Mapel berhasil diambil',
                'data' => $mapel
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data mapel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi Data
            $validator = Validator::make($request->all(), [
                'nama_mapel' => 'required|string|max:100',
                'tingkat_kesulitan' => 'required|string|max:50',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Simpan ke database
            $mapel = Mapel::create([
                'nama_mapel' => $request->nama_mapel,
                'tingkat_kesulitan' => $request->tingkat_kesulitan
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Mapel Berhasil Ditambahkan!',
                'data' => $mapel
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data mapel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $mapel = Mapel::find($id);

            if (!$mapel) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Mapel tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Mapel',
                'data' => $mapel
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data mapel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $mapel = Mapel::find($id);

            if (!$mapel) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Mapel tidak ditemukan'
                ], 404);
            }

            // Validasi Data
            $validator = Validator::make($request->all(), [
                'nama_mapel' => 'sometimes|required|string|max:100',
                'tingkat_kesulitan' => 'sometimes|required|string|max:50',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Update Data
            $mapel->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data Mapel Berhasil Diperbarui!',
                'data' => $mapel
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data mapel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mapel = Mapel::find($id);

            if (!$mapel) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Mapel tidak ditemukan'
                ], 404);
            }

            $mapel->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Mapel Berhasil Dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data mapel',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
