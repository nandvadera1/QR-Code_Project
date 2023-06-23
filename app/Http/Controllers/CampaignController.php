<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CampaignController extends Controller
{
    public function index()
    {
        $heads = [
            'Name',
            'Category',
            'Enabled',
            'Start Date',
            'End Date',
            'Amount',
            ['label' => 'Edit', 'no-export' => true, 'width' => 5],
            ['label' => 'Delete', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'processing' => true,
            'serverSide' => true,
            'ajax' => url('admin/campaigns/dataTable'),
            'columns' => [
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'category.name', 'name' => 'category.name'],
                ['data' => 'is_enabled', 'name' => 'is_enabled'],
                ['data' => 'start_at', 'name' => 'start_at'],
                ['data' => 'end_at', 'name' => 'end_at'],
                ['data' => 'amount', 'name' => 'amount'],
                ['data' => 'edit', 'name' => 'edit', 'orderable' => false, 'searchable' => false],
                ['data' => 'delete', 'name' => 'delete', 'orderable' => false, 'searchable' => false],
            ]
        ];
        return view('campaigns.index', compact('heads', 'config'));
    }

    public function dataTable(Request $request)
    {
        $categoryID = $request->input('category_id');

        $campaign = Campaign::with('category')
            ->when($categoryID, function ($query, $categoryID) {
                return $query->where('category_id', $categoryID);
            })
            ->select('id', 'category_id', 'is_enabled', 'name', 'start_at', 'end_at', 'amount')
            ->get();

        return DataTables::of($campaign)
            ->addColumn('is_enabled', function($campaign){
                if($campaign->is_enabled){
                    return 'True';
                }
                return 'False';
            })
            ->addColumn('edit', function ($campaign) {
                $btn = '<a href="/admin/campaigns/' . $campaign->id . '/edit" class="btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->addColumn('delete', function ($campaign) {
                $btn = '<button class="btn btn-danger btn-sm btn_delete" data-id="' . $campaign->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }

    public function create()
    {
        $categoryType = Category::pluck('name', 'id');
        $productType = Product::pluck('name', 'id');

        return view('campaigns.create', [
            'categoryType' => $categoryType,
            'productType' => $productType
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'is_enabled' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'amount' => 'required'
        ]);

        $campaign = Campaign::create($attributes);

        $productIds = $request->input('products', []);

        $campaign->products()->sync($productIds);

        return redirect('admin/campaigns')->with('success', 'Campaign Created Successfully');
    }

    public function edit(Campaign $campaign)
    {
        $selectedProducts = $campaign->products->pluck('id')->toArray();

        $categoryID = $campaign->category_id;
        $categoryType = Category::pluck('name', 'id');
        $productType = Product::pluck('name', 'id');

        return view('campaigns.edit', [
            'campaign' => $campaign,
            'categoryID' => $categoryID,
            'categoryType' => $categoryType,
            'productType' => $productType,
            'selectedProducts' => $selectedProducts,
        ]);
    }

    public function update(Request $request, Campaign $campaign)
    {
        $attributes = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'is_enabled' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'amount' => 'required'
        ]);

        $campaign->update($attributes);

        $productIds = $request->input('products', []);

        $campaign->products()->sync($productIds);

        return redirect('admin/campaigns')->with('success', 'Campaign Updated Successfully');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return 'Success';
    }

}

