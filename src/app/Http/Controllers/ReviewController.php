<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\Store;
use Auth;
use FileIO;

class ReviewController extends Controller
{
  private const dirName = 'reviewImages';

  // 口コミ一覧ページの表示
  public function reviews()
  {
    // 全ての口コミを取得
    $reviews = Review::Paginate(10);

    return view('admin.reviews', compact('reviews'));
  }

  // 口コミ投稿ページの表示
  public function review($store_id)
  {
    // IDが一致する飲食店を取得
    $store = Store::find($store_id);

    return view('review', compact('store'));
  }

  // 口コミを投稿
  public function create(ReviewRequest $request)
  {
    if (Auth::user()) {
      $user_id = Auth::user()->id;
      $store_id = $request->store_id;
      if (Review::checkReview($user_id, $store_id)) {
        return redirect('/detail/' . $store_id)->with('error', '既に口コミを投稿済みです。');
      } else {
        // 新しく口コミアイテムを作成
        $review = Review::create([
          'user_id' => $user_id,
          'store_id' => $store_id,
          'rate' => $request->rate,
          'comment' => $request->comment,
        ]);

        // 画像のアップロードと登録
        if (!is_null($request->file('images'))) {
          foreach ($request->file('images') as $image) {
            $imagePath = FileIO::uploadImageFile('reviewImages', $image);

            // 画像を登録
            ReviewImage::create([
              'review_id' => $review->id,
              'imageURL' => $imagePath
            ]);
          }
        }
      }

      // 画面を更新
      return redirect('/')->with('message', '口コミを投稿いただきありがとうございます。');
    }
  }

  // 口コミ編集ページの表示
  public function edit($review_id)
  {
    // IDが一致する口コミを取得
    $review = Review::find($review_id);
    // 口コミ先の飲食店を取得
    $store = $review->store;

    return view('review', compact('store', 'review'));
  }

  // 口コミの更新
  public function restore(ReviewRequest $request)
  {
    $review = Review::find($request->id);

    // 店舗情報の更新
    $review->update([
      'rate' => $request->rate,
      'comment' => $request->comment,
    ]);

    // 画像のアップロードと登録
    // dd($request->file('images'));
    if (!is_null($request->file('images'))) {
      foreach ($request->file('images') as $image) {
        $imagePath = FileIO::uploadImageFile(self::dirName, $image);

        // 画像を登録
        ReviewImage::create([
          'review_id' => $review->id,
          'imageURL' => $imagePath
        ]);
      }
    }

    // 画面を更新
    return redirect('/')->with('message', '口コミを更新しました');
  }

  // 口コミの削除
  public function destroy(Request $request)
  {
    $review = Review::find($request->id);

    // 紐づくデータを同時に削除
    foreach ($review->reviewImages as $reviewImage) {
      FileIO::deleteImageFile(self::dirName, $reviewImage->imageURL);
      $reviewImage->delete();
    }
    $review->delete();

    // 画面を更新
    if (Auth::check('admin'))
      return back()->with('error', '口コミを削除しました');
    else
      return redirect('/')->with('message', '口コミを削除しました');
  }
}
