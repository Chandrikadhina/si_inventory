<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
    /**
    * Display a listing of the resource.
    */
        // $rsetKategori = DB::table('kategori')->select('id','kategori',DB::raw('ketKategori(jenis) as ketkategori'))->get();
        // return $rsetKategori;

        // return DB::table('kategori')->get();

    // memanggil store procedure
        // return DB::select('CALL getKategoriAll()');

    // memanggil store procedure dengan view
        // $rsetKategori = DB::select('CALL getKategoriAll()');
        // return view('v_smartkoding.index',compact('rsetKategori'));

    $rsetKategori = Kategori::getKategoriAll()->paginate(10);
    return view('kategori.index',compact('rsetKategori'))
    ->with('i', (request()->input('page', 1) - 1) * 10);

        // $rsetKategori = DB::table('kategori')->select('id','deskripsi',DB::raw('ketKategorik(kategori) as ketkategorik'))->paginate(10);
        // return view('kategori.index',compact('rsetKategori'))
        //     ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akategori = array('blank'=>'Pilih Jenis',
                            'M'=>'Barang Modal',
                            'A'=>'Alat',
                            'BHP'=>'Bahan Habis Pakai',
                            'BTHP'=>'Bahan Tidak Habis Pakai'
                            );
        return view('kategori.create',compact('akategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
            'kategori'   => 'required',
            'jenis'     => 'required | in:M,A,BHP,BTHP',
        ]);


        //create post
        Kategori::create([
            'kategori'  => $request->kategori,
	        'jenis'   => $request->jenis,
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);

        // $rsetKategori = Kategori::select('id','deskripsi','kategori',
        //     \DB::raw('(CASE
        //         WHEN kategori = "M" THEN "Modal"
        //         WHEN kategori = "A" THEN "Alat"
        //         WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
        //         ELSE "Bahan Tidak Habis Pakai"
        //         END) AS ketKategori'))->where('id', '=', $id);

        return view('kategori.show', compact('rsetKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
        // $akategori = Kategori::all();
        $rsetKategori = Kategori::find($id);

        // $selectedKategori = Kategori::find($kategori->kategori_id);
        return view('kategori.edit', compact('rsetKategori'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'kategori'           => 'required',
            'jenis'              => 'required',
            // 'spesifikasi'       => 'required',
            // 'stok'              => 'required',
            // 'kategori_id'       => 'required',
        ]);

        $rsetKategori = Kategori::find($id);
            $rsetKategori->update([
                'kategori'              => $request->kategori,
                'jenis'              => $request->jenis,
                // 'spesifikasi'       => $request->spesifikasi,
                // 'stok'              => $request->stok,
                // 'kategori_id'       => $request->kategori_id
            ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Kategori Berhasil Diubah!']);
    }

    public function destroy(string $id)

    {

        //cek apakah kategori_id ada di tabel barang.kategori_id ?

        if (DB::table('barang')->where('kategori_id', $id)->exists()){

            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);


        } else {

            $rsetKategori = Kategori::find($id);

            $rsetKategori->delete();

            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);

        }

    }
    function kategoriAPI(){
        $kategori = Kategori::all();
        $data = array("data"=>$kategori);
        return response()->json($data);
    }

}