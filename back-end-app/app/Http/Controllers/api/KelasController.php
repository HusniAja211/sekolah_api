<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kelas = Kelas::all();
            return response()->json([
                'success' => true,
                'message' => 'Data Kelas berhasil diambil',
                'data' => $kelas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kelas',
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
                'nama_kelas' => 'required|string|max:100',
                'id_wali_kelas' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Simpan ke database
            $kelas = Kelas::create([
                'nama_kelas' => $request->nama_kelas,
                'id_wali_kelas' => $request->id_wali_kelas
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Kelas Berhasil Ditambahkan!',
                'data' => $kelas
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data kelas',
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
            $kelas = Kelas::find($id);

            if (!$kelas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Kelas tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Kelas',
                'data' => $kelas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kelas',
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
            $kelas = Kelas::find($id);

            if (!$kelas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Kelas tidak ditemukan'
                ], 404);
            }

            // Validasi Data
            $validator = Validator::make($request->all(), [
                'nama_kelas' => 'sometimes|required|string|max:100',
                'id_wali_kelas' => 'sometimes|required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Update Data
            $kelas->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data Kelas Berhasil Diperbarui!',
                'data' => $kelas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data kelas',
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
            $kelas = Kelas::find($id);

            if (!$kelas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Kelas tidak ditemukan'
                ], 404);
            }

            $kelas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Kelas Berhasil Dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data kelas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}