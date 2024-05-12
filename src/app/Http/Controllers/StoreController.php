<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Auth;
use Exception;
use FileIO;

class StoreController extends Controller
{
    private const dirName = 'storeImages';

    // 飲食店一覧ページを表示
    public function index()
    {
        // 全ての飲食店を取得
        $stores = Store::All();

        return view('index', compact('stores'));
    }

    // 飲食店詳細ページを表示
    public function showDetail($store_id)
    {
        // IDが一致する飲食店を取得
        $store = Store::find($store_id);
        // 飲食店の口コミを取得
        $reviews = $store->reviews;

        return view('detail', compact('store', 'reviews'));
    }

    // 飲食店のソートを実施
    public function sort(Request $request)
    {
        // dd($request);
        $stores = Store::all();
        switch ($request->order) {
            case 0:
                $stores = $stores->shuffle();
                break;
            case 1:
                $stores = $stores->sortbyDesc(function ($stores) {
                    // 評価が無いものは最後尾
                    if ($stores->reviews->count() == 0)
                        return 0;
                    else
                        return $stores->reviews->avg('rate');
                });
                break;
            case 2:
                $stores = $stores->sortby(function ($stores) {
                    // 評価が無いものは最後尾
                    if ($stores->reviews->count() == 0)
                        return 6;
                    else
                        return $stores->reviews->avg('rate');
                });
                break;
            default:
                break;
        }
        $request->session()->put('storesOrder', $stores);
        $stores = $this->filter($request, $stores);

        return view('index', compact('stores', 'request'));
    }

    // 飲食店の検索を実施
    public function search(Request $request)
    {
        $stores = $this->getStores($request);
        $stores = $this->filter($request, $stores);

        return view('index', compact('stores', 'request'));
    }

    // ソート済みの場合、ソート済みの飲食店情報を取得する
    public function getStores(Request $request)
    {
        if ($request->has('order') && $request->session()->has('storesOrder'))
            return $request->session()->get('storesOrder');
        else
            return Store::all();
    }

    // 検索フィルタ
    public function filter(Request $request, $item)
    {
        if (!empty($request->area_id) || $request->area_id != 0) {
            $item = $item->where('area_id', $request->area_id);
        }

        if (!empty($request->genre_id) || $request->genre_id != 0) {
            $item = $item->where('genre_id', $request->genre_id);
        }

        if (!empty($request->store_name)) {
            $item = $item->filter(function ($item) use ($request) {
                return preg_match("/$request->store_name/", $item->name);
            });
        }

        return $item;
    }

    // 店舗一覧ページを表示
    public function stores()
    {
        if (Auth::guard('admins')->check()) {          // 管理者権限
            // 全ての店舗を取得
            $stores = Store::Paginate(10);
            return view('admin.stores', compact('stores'));
        } else if (Auth::guard('managers')->check()) {   // 店舗代表者権限
            // 担当店舗を取得
            $manager = Auth::guard('managers')->user();
            $stores = Store::Where('manager_id', '=', $manager->id)->Paginate(10);

            return view('manager.stores', compact('stores'));
        }
    }

    // 店舗の新規登録ページを表示
    public function register()
    {
        return view('manager.storeRegister');
    }

    // 店舗の登録
    public function create(StoreRequest $request)
    {
        // 画像をアップロード
        $imagePath = null;
        if (!is_null($request->file('image'))) {
            $imagePath = FileIO::uploadImageFile(self::dirName, $request->file('image'));
        }

        // 店舗を登録
        $store = Store::create([
            'name' => $request->name,
            'manager_id' => $request->manager_id,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'imageURL' => $imagePath
        ]);

        // 画面を更新
        // return redirect()->route('manager.stores');
        $message = '新しく店舗を登録しました';
        return redirect()->route('manager.stores')->with(compact('message'));
    }

    // 店舗情報の更新ページの表示
    public function edit($store_id)
    {
        // IDが一致する飲食店を取得
        $store = Auth::guard('managers')->user()->stores->find($store_id);

        if (is_null($store)) {
            $error = '店舗情報が見つかりません';
            return redirect()->route('manager.stores')->with(compact('error'));
        }
        return view('manager.storeEditor', compact('store'));
    }

    // 店舗情報の更新
    public function restore(StoreRequest $request)
    {
        $store = Store::find($request->id);

        // 画像をアップロード
        $imagePath = $store->imageURL;
        if (!is_null($request->file('image'))) {
            FileIO::deleteImageFile(self::dirName, $store->imageURL);
            $imagePath = FileIO::uploadImageFile(self::dirName, $request->file('image'));
        }

        // 店舗情報の更新
        $store->update([
            'name' => !is_null($request->name) ? $request->name : $store->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => !is_null($request->description) ? $request->description : $store->description,
            'imageURL' => $imagePath
        ]);

        // 画面を更新
        $message = '登録情報を更新しました';
        return redirect()->route('manager.stores')->with(compact('message'));
    }

    // 店舗の削除
    public function destroy(Request $request)
    {
        $store = Store::find($request->id);
        // 紐づくデータを同時に削除
        foreach ($store->bookings as $booking)
            $booking->delete();
        foreach ($store->favorites as $favorite)
            $favorite->delete();
        $store->delete();

        // 画面を更新
        // return redirect()->route('manager.stores');
        $error = '登録情報を削除しました';
        return redirect()->route('manager.stores')->with(compact('error'));
    }

    // 店舗の一括削除
    public function batchDestroy(Request $request)
    {
        foreach (Store::all() as $store) {
            if (!is_null($request->input($store->id))) {
                // 紐づくデータを同時に削除
                foreach ($store->bookings as $booking)
                    $booking->delete();
                foreach ($store->favorites as $favorite)
                    $favorite->delete();
                $store->delete();
            }
        };

        // 画面を更新
        $error = '登録情報を削除しました';
        return redirect()->route('manager.stores')->with(compact('error'));
    }
}
