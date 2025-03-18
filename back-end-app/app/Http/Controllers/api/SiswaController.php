<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $siswa = Siswa::all();
            return response()->json([
                'success' => true,
                'message' => 'Data Siswa berhasil diambil',
                'data' => $siswa
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data siswa',
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
                'nama_siswa' => 'required|string|max:100',
                'alamat' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'kelas_id_kelas' => 'required|integer|exists:kelas,id_kelas'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Simpan ke database
            $siswa = Siswa::create([
                'nama_siswa' => $request->nama_siswa,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kelas_id_kelas' => $request->kelas_id_kelas
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Siswa Berhasil Ditambahkan!',
                'data' => $siswa
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data siswa',
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
            $siswa = Siswa::find($id);

            if (!$siswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Siswa tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Siswa',
                'data' => $siswa
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data siswa',
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
            $siswa = Siswa::find($id);

            if (!$siswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Siswa tidak ditemukan'
                ], 404);
            }

            // Validasi Data
            $validator = Validator::make($request->all(), [
                'nama_siswa' => 'sometimes|required|string|max:100',
                'alamat' => 'sometimes|required|string|max:255',
                'tanggal_lahir' => 'sometimes|required|date',
                'kelas_id_kelas' => 'sometimes|required|integer|exists:kelas,id_kelas'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Update Data
            $siswa->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data Siswa Berhasil Diperbarui!',
                'data' => $siswa
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data siswa',
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
            $siswa = Siswa::find($id);

            if (!$siswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Siswa tidak ditemukan'
                ], 404);
            }

            $siswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Siswa Berhasil Dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data siswa',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
