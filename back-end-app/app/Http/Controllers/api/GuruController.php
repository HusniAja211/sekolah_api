<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $gurus = Guru::all();
            return response()->json([
                'success' => true,
                'message' => 'Data Guru berhasil diambil',
                'data' => $gurus
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data guru',
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
                'nama_guru' => 'required|string|max:100',
                'spesialisasi' => 'required|string|max:100',
                'nomor_hp' => 'required|string|max:13'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Simpan ke database
            $guru = Guru::create([
                'nama_guru' => $request->nama_guru,
                'spesialisasi' => $request->spesialisasi,
                'nomor_hp' => $request->nomor_hp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Ditambahkan!',
                'data' => $guru
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
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
            $guru = Guru::find($id);

            if (!$guru) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Guru tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Guru',
                'data' => $guru
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data',
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
            $guru = Guru::find($id);

            if (!$guru) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Guru tidak ditemukan'
                ], 404);
            }

            // Validasi Data
            $validator = Validator::make($request->all(), [
                'nama_guru' => 'sometimes|required|string|max:100',
                'spesialisasi' => 'sometimes|required|string|max:100',
                'nomor_hp' => 'sometimes|required|string|max:13'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Update Data
            $guru->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diperbarui!',
                'data' => $guru
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data',
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
            $guru = Guru::find($id);

            if (!$guru) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Guru tidak ditemukan'
                ], 404);
            }

            $guru->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
