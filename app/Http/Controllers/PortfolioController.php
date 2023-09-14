<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    function index() : View {
        $portfolio = Portfolio::where('status', '1')->get();

        $selectOptions = [
            'option1' => 'Option 1',
            'option2' => 'Option 2',
            'option3' => 'Option 3',
        ];

        return view('portfolio.index', compact(
            'portfolio',
            'selectOptions',
        ));
    }

    function store(Request $request) : RedirectResponse {
        $validator = Validator::make($request->all(), [
            'client'        => 'required',
            'thumbnail'     => 'required',
            'title'         => 'required',
            'category'      => 'required',
            'desc'          => 'nullable',
            'project_date'  => 'required',
            'project_url'   => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with('errortoast', $validator->errors()->first())->withInput();
        }

        try {
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = $thumbnail->getClientOriginalName();
                $thumbnail->storeAs('public/portfolio/thumbnails', $thumbnailName);
            }

            $portfolio = Portfolio::create([
                'client'        => $request->client,
                'thumbnail'     => $thumbnailName,
                'title'         => $request->title,
                'category'      => $request->category,
                'desc'          => $request->desc,
                'project_date'  => $request->project_date,
                'project_url'   => $request->project_url,
            ]);

            return redirect()->back()->with(['success' => 'Portfolio added successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Portfolio failed to add: ' . $e->getMessage()]);
        }

    }

    function editPortfolio(Request $request, $id) : RedirectResponse {
        $validator = Validator::make($request->all(), [
            'client'        => 'required',
            'thumbnail'     => 'sometimes',
            'title'         => 'required',
            'category'      => 'required',
            'desc'          => 'nullable',
            'project_date'  => 'required',
            'project_url'   => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with('errortoast', $validator->errors()->first())->withInput();
        }

        try {
            $portfolio = Portfolio::find($id);

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = Carbon::now()->format('YmdHis') . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->storeAs('public/portfolio', $thumbnailName);

                // Update data dengan gambar terbaru
                $portfolio->thumbnail = $thumbnailName;
            }

            $portfolio->title = $request->title;
            $portfolio->category = $request->category;
            $portfolio->desc = $request->desc;
            $portfolio->project_date = $request->project_date;
            $portfolio->project_url = $request->project_url;
            $portfolio->save();

            return redirect()->back()->with(['successtoast' => 'Image updated successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Image failed to update: ' . $e->getMessage()]);
        }
    }

    function deletePortfolio($id) : RedirectResponse {
        try {
            $portfolio = Portfolio::find($id);
            $portfolio->status = '0';
            $portfolio->save();

            return redirect()->back()->with(['successtoast' => 'Portfolio deleted successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Portfolio failed to delete: ' . $e->getMessage()]);
        }
    }

    function detail($id) : View {
        $portfolio = Portfolio::where('id', $id)
        ->get();

        $portfolioImage = PortfolioImage::where('portfolio_id', $id)
        ->where('status', '1')
        ->orderBy('placement', 'asc')
        ->get();

        $portfolioId = $id;

        $count = PortfolioImage::where('portfolio_id', $id)->count();
        $placement = $count + 1;

        return view('portfolio.detail', compact(
            'portfolio',
            'portfolioImage',
            'portfolioId',
            'placement',
        ));
    }

    function addPortfolioImage(Request $request) : RedirectResponse {
        $validator = Validator::make($request->all(), [
            'portfolio_id'  => 'required',
            'image'         => 'required',
            'placement'     => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('errortoast', $validator->errors()->first())->withInput();
        }

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Carbon::now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/portfolio', $imageName);
            }

            $imagePortfolio = PortfolioImage::create([
                'portfolio_id'  => $request->portfolio_id,
                'image'         => $imageName,
                'placement'     => $request->placement,
            ]);

            return redirect()->back()->with(['successtoast' => 'Image added successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Image failed to add: ' . $e->getMessage()]);
        }
    }

    function editPortfolioImage(Request $request, $id) : RedirectResponse {
        $validator = Validator::make($request->all(), [
            'image'         => 'sometimes',
            'placement'     => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('errortoast', $validator->errors()->first())->withInput();
        }

        try {
            $imagePortfolio = PortfolioImage::find($id);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = Carbon::now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/portfolio', $imageName);

                // Update data dengan gambar terbaru
                $imagePortfolio->image = $imageName;
            }

            $imagePortfolio->placement = $request->placement;
            $imagePortfolio->save();

            return redirect()->back()->with(['successtoast' => 'Image updated successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Image failed to update: ' . $e->getMessage()]);
        }
    }

    function deletePortfolioImage($id) : RedirectResponse {
        try {
            $imagePortfolio = PortfolioImage::find($id);
            $imagePortfolio->status = '0';
            $imagePortfolio->save();

            return redirect()->back()->with(['successtoast' => 'Image deleted successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['errortoast' => 'Image failed to delete: ' . $e->getMessage()]);
        }
    }
}
