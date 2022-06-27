<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('user')->where('id_user', auth()->user()->id)->get();
        return view('admin/index', [
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_menu = IdGenerator::generate([
            'table' => 'tabel_menu',
            'field' => 'kode_menu',
            'length' => 8,
            'prefix' => 'MENU-',
            'reset_on_prefix_change' => true
        ]);
        $kategori = [
            'Makanan',
            'Minuman',
        ];
        return view('admin/create', [
            'kode_menu' => $kode_menu,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'foto' => 'mimes:jpg,jpeg,png|dimensions:ratio=1/1',
        ], [
            'nama_menu.required' => 'Nama menu masih kosong',
            'harga.required' => 'Harga masih kosong',
            'kategori.required' => 'Kategori masih kosong',
            'foto.mimes' => 'Foto tidak sesuai (jpg,jpeg,png)',
            'foto.dimensions' => 'Ukuran foto tidak sesuai (1:1)',
        ]);
        $validated['id_user'] = auth()->user()->id;
        $validated['kode_menu'] = $request->kode_menu;
        if ($request->file('foto')) {
            $validated['foto'] = $request->file('foto')->store('menu');
        }
        Menu::create($validated);
        return redirect('/admin')->with('berhasil', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $kategori = [
            'Makanan',
            'Minuman',
        ];
        return view('admin/edit', [
            'kategori' => $kategori,
            'menu' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required',
            'foto' => 'mimes:jpg,jpeg,png|dimensions:ratio=1/1',
        ], [
            'nama_menu.required' => 'Nama menu masih kosong',
            'harga.required' => 'Harga masih kosong',
            'foto.mimes' => 'Foto tidak sesuai (jpg,jpeg,png)',
            'foto.dimensions' => 'Ukuran foto tidak sesuai (1:1)',
        ]);
        $validated['kategori'] = $request->kategori;
        if ($request->file('foto')) {
            if ($menu->foto) {
                Storage::delete($menu->foto);
            }
            $validated['foto'] = $request->file('foto')->store('menu');
        }
        Menu::where('id', $menu->id)->update($validated);
        return redirect('/admin')->with('berhasil', 'Menu berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->foto) {
            Storage::delete($menu->foto);
        }
        Menu::destroy($menu->id);
        return redirect('/admin')->with('berhasil', 'Menu berhasil dihapus!');
    }
}
