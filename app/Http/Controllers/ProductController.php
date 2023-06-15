<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryID = $request->input('category_id');

        $heads = [
            'Product Name',
            'Category',
            ['label' => 'Edit', 'no-export' => true, 'width' => 5],
            ['label' => 'Delete', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'processing' => true,
            'serverSide' => true,
            'ajax' => [
                'url' => url('admin/products/dataTable'),
            ],
            'columns' => [
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'category.name', 'name' => 'category.name'],
                ['data' => 'edit', 'name' => 'edit', 'orderable' => false, 'searchable' => false],
                ['data' => 'delete', 'name' => 'delete', 'orderable' => false, 'searchable' => false],
            ]
        ];

        $categories = Category::all();

        return view('products.index', compact('heads', 'config', 'categories', 'categoryID'));
    }

    public function dataTable(Request $request)
    {
        $categoryID = $request->input('category_id');

        $products = Product::with('category')
            ->when($categoryID, function ($query, $categoryID) {
                return $query->where('category_id', $categoryID);
            })
            ->select('id', 'category_id', 'name')
            ->get();

        return DataTables::of($products)
            ->addColumn('edit', function ($product) {
                $btn = '<a href="/admin/products/' . $product->id . '/edit" class="btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->addColumn('delete', function ($product) {
                $btn = '<button class="btn btn-danger btn-sm btn_delete" data-id="' . $product->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }

    public function create(Request $request)
    {
        $categoryID = $request->query('category_id');

        $category = Category::find($categoryID);

        $categoryType = Category::pluck('name', 'id');

        return view('products.create', [
            'category' => $category,
            'categoryID' => $categoryID,
            'categoryType' => $categoryType
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'category_id' => 'required',
            'name' => 'required|max:255',
        ]);

        Product::create($attributes);

        return redirect("/admin/products")->with('success', 'Product Added Successfully!');
    }

    public function edit(Product $product)
    {
        $categoryID = $product->category_id;

        $categoryType = Category::pluck('name', 'id');

        return view('products.edit', [
            'product' => $product,
            'categoryID' => $categoryID,
            'categoryType' => $categoryType
        ]);
    }

    public function update(Product $product)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
        ]);

        $attributes['category_id'] = $product->category_id;

        $product->update($attributes);

        return back()->with('success', 'Product Updated Successfully!!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back();
    }
}
