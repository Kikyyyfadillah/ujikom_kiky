<?php

namespace App\Http\Controllers;

use App\Exports\menuExport;
use App\Models\menu;
use App\Http\Requests\StoremenuRequest;
use App\Http\Requests\UpdatemenuRequest;
use App\Imports\menuImport;
use App\Models\jenis;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class menuController extends Controller
{
    public function index()
    {
        $data['menu'] = menu::with(['jenis'])->get();
        $data['jenis'] = jenis::get();
        return view('menu.index')->with($data);
    }
    public function store(StoremenuRequest $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image'), $imageName);
        $data = $request->all();
        $data['image'] = $imageName;

        menu::create($data);

        return redirect('menu')->with('success', 'Data menu berhasil di tambahkan!');

        return back()->with('success' . 'You have successfully uploaded ann image.')->with('image', $imageName);
    }
    public function update(UpdatemenuRequest $request, string $id)
    {
        $menu = menu::find($id)->update($request->all());
        return redirect('menu')->with('success', 'Update data berhasil');
    }
    public function destroy($id)
    {
        menu::find($id)->delete();
        return redirect('menu')->with('success', 'Data menu berhasil dihapus!');
    }
    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new menuExport, $date . '_menu.xlsx');
    }
    public function importData()
    {
        Excel::import(new menuImport, request()->file('import'));
        return redirect(request()->segment(1) . '/menu')->with('success', 'Import data menu berhasil');
    }
    public function pdf()
    {
        $menu = menu::all();
        $pdf = Pdf::loadView('menu.data', compact('menu'));
        return $pdf->download('menu.pdf');
    }
}
