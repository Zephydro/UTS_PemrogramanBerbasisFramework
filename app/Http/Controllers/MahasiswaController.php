<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Exports\MahasiswaExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    // READ
    public function index(Request $request)
    {
        try {
            $search = $request->search;
            $perPage = 8; // Number of items per page
            
            $query = Mahasiswa::query();
            
            // Apply search filter if search term exists
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('nim', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }
            
            // Get paginated results
            $mahasiswa = $query->latest()
                             ->paginate($perPage)
                             ->withQueryString();
                             
            return view('mahasiswa.index', compact('mahasiswa', 'search'));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }

        return view('mahasiswa.index', compact('mahasiswa', 'search'));
    }

    // CREATE FORM
    public function create()
    {
        return view('mahasiswa.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas',
            'email' => 'required|email|unique:mahasiswas',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success','Data berhasil ditambahkan!');
    }

    // EDIT FORM
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // UPDATE
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,'.$mahasiswa->id,
            'email' => 'required|email|unique:mahasiswas,email,'.$mahasiswa->id,
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success','Data berhasil diperbarui!');
    }

    // DELETE
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success','Data berhasil dihapus!');
    }

    // Generate PDF
    public function generatePDF()
    {
        $mahasiswa = Mahasiswa::all();
        $pdf = PDF::loadView('mahasiswa.pdf', compact('mahasiswa'));
        return $pdf->stream('daftar-mahasiswa.pdf');
    }

    // Export Excel
    public function exportExcel()
    {
        $date = now()->format('d-m-Y');
        return Excel::download(new MahasiswaExport, "daftar-mahasiswa-{$date}.xlsx");
    }
}
