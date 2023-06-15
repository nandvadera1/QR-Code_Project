<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $heads = [
            'Name',
            ['label' => 'Edit', 'no-export' => true, 'width' => 5],
            ['label' => 'Delete', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'processing' => true,
            'serverSide' => true,
            'ajax' => url('admin/categories/dataTable'),
            'columns' => [
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'edit', 'name' => 'edit', 'orderable' => false, 'searchable' => false],
                ['data' => 'delete', 'name' => 'delete', 'orderable' => false, 'searchable' => false],
            ]
        ];
        return view('categories.index', compact('heads', 'config'));
    }

    public function dataTable()
    {
        $categories = Category::select('id', 'name')->get();

        return DataTables::of($categories)
            ->addColumn('edit', function ($categories) {
                $btn = '<a href="/admin/categories/' . $categories->id . '/edit" class="btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->addColumn('delete', function ($categories) {
                $btn = '<button class="btn btn-danger btn-sm btn_delete " data-id="' . $categories->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255'
        ]);

        Category::create($attributes);

        return redirect('/admin/categories')->with('success', 'Category Added Successfully!!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
        ]);

        $category->update($attributes);

        return redirect('/admin/categories')->with('success', 'Category Updated Successfully!!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back();
    }
}
