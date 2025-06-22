<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar barang (READ)
     */
    public function index(Request $request)
    {
        $items = Item::all(); // Ambil semua data dari model Item
        return view('items.index', compact('items'));

        $search = $request->input('search'); // Ambil keyword pencarian
    
        $items = Item::when($search, function ($query, $search) {
                return $query->where('name', 'like', '%'.$search.'%')
                             ->orWhere('notes', 'like', '%'.$search.'%');
             })
             ->get();
        return view('items.index', compact('items'));
    }

    /**
     * Menampilkan form tambah barang (CREATE)
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Menyimpan barang baru ke database (STORE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:items|max:255',
            'quantity' => 'required|numeric|min:1',
            'notes' => 'nullable|string'
        ]);

        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit barang (EDIT)
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id); // Cari barang berdasarkan ID
        return view('items.edit', compact('item'));
    }

    /**
     * Update data barang (UPDATE)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:items,name,' . $id,
            'quantity' => 'required|numeric|min:1',
            'notes' => 'nullable|string'
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui!');
    }

    /**
     * Hapus barang (DELETE)
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}
