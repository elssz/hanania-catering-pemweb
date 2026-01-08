<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

   public function store(Request $request)
    {

        $data = $request->validate([
            'namaMenu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048' // Validasi gambar
        ]);

        
        $menu = Menu::create($data);
        
        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();
            $filename = 'menu_' . str_pad($menu->id, 5, '0', STR_PAD_LEFT) . '_' . time() . '.' . $ext;
            $path = public_path('menu');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $file->move($path, $filename);
            
            //upload img gambar
            $menu->gambar = 'menu/' . $filename;
            $menu->save(); 
        }

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

   public function update(Request $request, Menu $menu)
    {
        // 1. Validasi input (tambahkan validasi untuk gambar)
        $data = $request->validate([
            'namaMenu' => 'required|string|max:255',
            'harga'    => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // optional saat update
        ]);

        // 2. Cek apakah user mengunggah file gambar baru
        if ($request->hasFile('gambar')) {
            
            // A. Hapus gambar lama dari folder jika ada
            if ($menu->gambar && file_exists(public_path('images/menu/' . $menu->gambar))) {
                unlink(public_path('images/menu/' . $menu->gambar));
            }

            // B. Proses upload gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->namaMenu) . '.' . $file->getClientOriginalExtension();
            
            // C. Pindahkan ke folder public/images/menu
            $file->move(public_path('images/menu'), $filename);

            // D. Masukkan nama file baru ke dalam array data untuk disimpan
            $data['gambar'] = $filename;
        }

        // 3. Update data di database
        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus');
    } 


}
