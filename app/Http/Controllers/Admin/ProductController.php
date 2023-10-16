<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TemporaryFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(8);
        $products->appends(request()->query());

        return view('ap.product', compact('products'));
    }


    public function doProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'barcode' => 'required',
            'description' => 'required',
            'specification' => 'required',
            'price' => 'required',
            'color' => 'required',
            'size' => 'required',
            'media' => 'required',
        ]);
        $temporaryImages = TemporaryFile::all();

        if ($validator->fails()) {
            foreach ($temporaryImages as $temporaryImage) {
                Storage::deleteDirectory('img/product/tmp/' . $temporaryImage->folder);
                $temporaryImage->delete();
            }
            return to_route('admin.profile')->withErrors($validator)->withInput();
        }


        // Вземете всички данни от заявката
        $data = $request->all();

        // Създайте нов продукт в базата данни
        $product = new Product();
        $product->name = $data['name'];
        $product->barcode = $data['barcode'];
        $product->description = $data['description'];
        $product->specification = $data['specification'];
        $product->price = $data['price'];

        // Проверете дали е избрано "Discounted" и добавете съответната цена
        if ($data['discount-type'] === 'discounted') {
            $product->discount = $data['discount'];
        } else {
            $product->discount = null;
        }

        // Запишете продукта в базата данни
        $product->save();

        // Свържете продукта с категорията
        $product->category_id = $data['category_id'];

        // Запишете избраните цветове и размери
        $product->color = json_encode($data['color']);
        $product->size = json_encode($data['size']);

        // Запишете специфичните размери
        $product->xxs = $data['sizeXXS'];
        $product->xs = $data['sizeXS'];
        $product->s = $data['sizeS'];
        $product->m = $data['sizeM'];
        $product->l = $data['sizeL'];
        $product->xl = $data['sizeXL'];
        $product->xxl = $data['sizeXXL'];
        $product->xxxl = $data['sizeXXXL'];

        $product->save();

        $targetDirectory = 'img/product/product-'. $product->id;

        if (!File::isDirectory(public_path($targetDirectory))) {
            File::makeDirectory(public_path($targetDirectory), 0755, true, true);
        }

        foreach ($temporaryImages as $i => $temporaryImage) {
            File::move(storage_path('app/img/product/tmp/' . $temporaryImage->folder . '/' . $temporaryImage->filename), public_path($targetDirectory . '/' . $i . '.' . $temporaryImage->extension ));
            Storage::deleteDirectory('img/product/tmp/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        return to_route('admin.profile');


    }

    public function uploadTempProduct(Request $request)
    {

       if ($request->hasFile('media')) {
           $file = $request->file('media');
           $filename = $file->getClientOriginalName();
           $extension = $file->getClientOriginalExtension();
           $folder = uniqid() . '-' . now()->timestamp;
           $file->storeAs('img/product/tmp/' . $folder,$filename);

           TemporaryFile::create([
               'folder' => $folder,
               'filename' => $filename,
               'extension' => $extension
           ]);

           return $folder;
       }

       return '';
    }

    public function deleteTempProduct()
    {
        $temporaryImage = TemporaryFile::where('folder', request()->getContent())->first();
        if ($temporaryImage) {
            Storage::deleteDirectory('img/product/tmp/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        return response()->noContent();
    }
}
