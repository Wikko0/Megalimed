<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::paginate(8);
        $categories->appends(request()->query());

        return view('ap.category', compact('categories'));
    }

    public function doCategory(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|int|unique:categories,number',
            'name' => 'required|string|max:255',
            'menu' => 'required|string|max:255',
            'url' => ['required', 'string', 'max:10', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.category')->withErrors($validator)->withInput();
        }

        $lastCategory = Category::latest()->first();
        $lastResult = $lastCategory ? $lastCategory->id + 1 : 1;

        $file = $request->file("image");
        $photoPath = $file->storeAs('/img/categories', 'categories-'.$lastResult.'.jpg',['disk' => 'public_uploads']);

        $photo = Image::make(public_path("{$photoPath}"));
        $photo->save();

        Category::create([
            'number' => $request->input('number'),
            'name' => $request->input('name'),
            'menu' => $request->input('menu'),
            'url' => $request->input('url'),
            'description' => $request->input('description'),
            'image' => $photoPath,
            ]);

        return redirect()->route('admin.category')->withSuccess('Успешно създадохте категория.');
    }

    public function deleteCategory($id)
    {
        $categories = Category::where('id', $id)->get();
        foreach ($categories as $category) {
            $category->delete();
        }

        return redirect()->back()->withSuccess('Усшено изтрихте тази категория!');
    }

    public function editCategoryView($id): View
    {
        $category = Category::findOrFail($id);

        return view('ap.editCategory', compact('category'));
    }

    public function editCategory(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|int|unique:categories,number',
            'name' => 'required|string|max:255',
            'menu' => 'required|string|max:255',
            'url' => ['required', 'string', 'max:10', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.category.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $category = Category::findOrFail($id);
        $data = $request->all();

        $category->number = $data['number'];
        $category->name = $data['name'];
        $category->url = $data['url'];
        $category->description = $data['description'];
        $category->menu = $data['menu'];

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $file = $request->file("image");
            $photoPath = $file->storeAs('/img/categories', 'categories-'.$id.'.jpg',['disk' => 'public_uploads']);

            $photo = Image::make(public_path("{$photoPath}"));
            $photo->save();

            $category->image = $photoPath;
        }

        $category->save();

        return redirect()->route('admin.category.edit', $id)->withSuccess('Успешно редактирахте категорията.');
    }

}
