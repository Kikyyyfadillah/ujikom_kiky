<?php

namespace App\Http\Controllers;

use App\Exports\menuExport;
use App\Models\menu;
use App\Http\Requests\StoremenuRequest;
use App\Http\Requests\UpdatemenuRequest;
use App\Imports\menuImport;
use App\Models\jenis;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Database\QueryException;
// use Illuminate\Support\Facades\View as FacadesView;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'image' => 'image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image'), $imageName);
        $data = $request->all();
        $data['image'] = $imageName;

        menu::create($data);

        return redirect('menu')->with('success', 'Data menu berhasil di tambahkan!');

        return back()->with('success' . 'You have successfully uploaded ann image.')->with('image', $imageName);
    }
    public function update(StoreMenuRequest $request, string $id)
    {
        $data = $request->all();
        $menu = Menu::find($id);
        $request->validate([
            'image' => 'image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);
        $imageName = '';
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image'), $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = $menu->image;
        }

        $menu->update($data);

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
        return redirect(request()->segment(1))->with('success', 'Import data menu berhasil');
    }
    public function generatepdf()
    {
        // Get data
        $menu = Menu::with(['jenis'])->get();


        $pdf = PDF::loadview('menu.pdf', compact('menu'));
        return $pdf->download('menu.pdf');

        // // Loop through menu items and encode images to base64
        // foreach ($menu as $p) {
        //     $imagePath = public_path('image/' . $p->image);
        //     if (file_exists($imagePath)) {
        //         $imageData = base64_encode(file_get_contents($imagePath));
        //         $p->imageData = $imageData;
        //     } else {
        //         // Handle the case where the image file doesn't exist
        //         $p->imageData = null; // Or any other appropriate handling
        //     }
        // }

        // // Generate PDF
        // $dompdf = new Dompdf();
        // $html = View::make('menu.data', compact('menu'))->render();
        // $dompdf->loadHtml($html);
        // $dompdf->render();

        // // Return the PDF as a download
        // return $dompdf->stream('menu.pdf');
    }
}
