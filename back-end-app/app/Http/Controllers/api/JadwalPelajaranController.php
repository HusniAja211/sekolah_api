<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jadwal_pelajaran;
use Illuminate\Support\Facades\Validator;

class JadwalPelajaranController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal pelajaran.
     */
    public function index()
    {
        try {
            $jadwal = jadwal_pelajaran::all();
            return response()->json([
                'success' => true,
                'message' => 'Data jadwal pelajaran berhasil diambil',
                'data' => $jadwal
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data jadwal pelajaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menyimpan data jadwal pelajaran baru.
     */
    public function store(Request $request)
    {
        try {
            // Validasi Data
            $validator = Validator::make($request->all(), [
                'hari' => 'required|string|max:20',
                'jam_mulai' => 'required|date_format:H:i:s',
                'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
                'guru_id_guru' => 'required|integer|exists:guru,id_guru',
                'kelas_id_kelas' => 'required|integer|exists:kelas,id_kelas',
                'mapel_id_mapel' => 'required|integer|exists:mapel,id_mapel',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Simpan ke database
            $jadwal = jadwal_pelajaran::create([
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'guru_id_guru' => $request->guru_id_guru,
                'kelas_id_kelas' => $request->kelas_id_kelas,
                'mapel_id_mapel' => $request->mapel_id_mapel
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal pelajaran berhasil ditambahkan!',
                'data' => $jadwal
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data jadwal pelajaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail jadwal pelajaran berdasarkan ID.
     */
    public function show($id)
    {
        try {
            $jadwal = jadwal_pelajaran::find($id);

            if (!$jadwal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal pelajaran tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail jadwal pelajaran',
                'data' => $jadwal
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data jadwal pelajaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengupdate data jadwal pelajaran berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        try {
            $jadwal = jadwal_pelajaran::find($id);

            if (!$jadwal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal pelajaran tidak ditemukan'
                ], 404);
            }

            // Validasi Data
            $validator = Validator::make($request->all(), [
                'hari' => 'sometimes|required|string|max:20',
                'jam_mulai' => 'sometimes|required|date_format:H:i:s',
                'jam_selesai' => 'sometimes|required|date_format:H:i:s|after:jam_mulai',
                'guru_id_guru' => 'sometimes|required|integer|exists:guru,id_guru',
                'kelas_id_kelas' => 'sometimes|required|integer|exists:kelas,id_kelas',
                'mapel_id_mapel' => 'sometimes|required|integer|exists:mapel,id_mapel',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Update Data
            $jadwal->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Jadwal pelajaran berhasil diperbarui!',
                'data' => $jadwal
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data jadwal pelajaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus data jadwal pelajaran berdasarkan ID.
     */
    public function destroy($id)
    {
        try {
            $jadwal = jadwal_pelajaran::find($id);

            if (!$jadwal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal pelajaran tidak ditemukan'
                ], 404);
            }

            $jadwal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal pelajaran berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data jadwal pelajaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
