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
            'name' => 'required|unique:products',
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
            return redirect()->route('admin.product')->withErrors($validator)->withInput();
        }



        $data = $request->all();


        $product = new Product();
        $product->name = $data['name'];
        $product->barcode = $data['barcode'];
        $product->description = $data['description'];
        $product->specification = $data['specification'];
        $product->price = $data['price'];


        if ($data['discount-type'] === 'discounted') {
            $product->discount = $data['discount'];
        } else {
            $product->discount = null;
        }


        $product->save();


        $product->category_id = $data['category_id'];


        $product->color = json_encode($data['color']);
        $product->size = json_encode($data['size']);
        $product->stock = json_encode($data['stock']);

        $product->status = 'Published';

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

        return redirect()->route('admin.product')->withSuccess('Успешно създадохте продукт.');;


    }

    public function deleteProduct($id)
    {
        $products = Product::where('id', $id)->get();
        foreach ($products as $product) {
            $productFolder = public_path('img/product/product-' . $product->id);

            if (File::exists($productFolder)) {
                File::deleteDirectory($productFolder);
            }

            $product->delete();
        }

        return redirect()->back()->withSuccess('Усшено изтрихте този продукт!');
    }

    public function statusProduct($id)
    {
        $products = Product::where('id', $id)->get();
        foreach ($products as $product) {

        if ($product->status == 'Published')
        {
            $product->update(['status' => 'Inactive']);
        } else
        {
            $product->update(['status' => 'Published']);
        }

        }

        return redirect()->back()->withSuccess('Усшено инактивирахте този продукт!');
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

    public function editProductView($id): View
    {
        $product = Product::findOrFail($id);
        $stock = json_decode($product->stock, true);

        $variants = [];

        foreach ($stock as $key => $value) {
            list($color, $size) = explode('-', $key);
            $variants[] = [
                'color' => $color,
                'size' => $size,
                'quantity' => $value,
            ];
        }

        return view('ap.editProduct', compact('product', 'variants'));
    }


    public function editProduct(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,' . $id,
            'barcode' => 'required',
            'description' => 'required',
            'specification' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.product.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::findOrFail($id);
        $data = $request->all();

        $product->name = $data['name'];
        $product->barcode = $data['barcode'];
        $product->description = $data['description'];
        $product->specification = $data['specification'];
        $product->price = $data['price'];
        if ($request->color && $request->size) {
            $newColors = $request->color;
            $newSizes = $request->size;

            $currentColors = $product->color;
            $currentSizes = $product->size;


            if ($currentColors) {
                $currentColorsArray = json_decode($currentColors, true);

                if (is_array($currentColorsArray)) {
                    $updatedColorsArray = array_values(array_unique(array_merge($currentColorsArray, $newColors)));
                    $updatedColors = json_encode($updatedColorsArray);
                } else {
                    $updatedColors = json_encode($newColors);
                }
            } else {
                $updatedColors = json_encode($newColors);
            }


            if ($currentSizes) {
                $currentSizesArray = json_decode($currentSizes, true);

                if (is_array($currentSizesArray)) {
                    $updatedSizesArray = array_values(array_unique(array_merge($currentSizesArray, $newSizes)));
                    $updatedSizes = json_encode($updatedSizesArray);
                } else {
                    $updatedSizes = json_encode($newSizes);
                }
            } else {
                $updatedSizes = json_encode($newSizes);
            }

            $product->color = $updatedColors;
            $product->size = $updatedSizes;
        }




        if ($data['discount-type'] === 'discounted') {
            $product->discount = $data['discount'];
        } else {
            $product->discount = null;
        }

        $product->category_id = $data['category_id'];
        $product->stock = json_encode($data['stock']);
        $product->save();

        return redirect()->route('admin.product.edit', $id)->withSuccess('Успешно редактирахте продукта.');
    }

}
