<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Enums\CatStatus;
use App\Enums\CatGender;

class CatController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    // 検索クエリのベース
    $query = Cat::query();

    // 猫IDで絞込（入力されていれば）
    if($request->filled('cat_id')) {
      $query->where('cat_id', $request->cat_id);
    }

    // 猫名で絞込（入力されていれば）※あいまい検索
    if($request->filled('cat_name')) {
      $query->where('cat_name', 'like', '%'.$request->cat_name.'%');
    }

    // ステータスで絞込（入力されていれば）
    if( $request->filled('cat_status') ) {
      $query->where('cat_status', $request->cat_status);
    }

    // 猫種類で絞込（入力されていれば）
    if($request->filled('breed_status')) {
      $query->where('breed', $request->breed_status);
    }

    // 性別で絞込（入力されていれば）
    if($request->filled('cat_gender')) {
      $query->where('gender', $request->cat_gender);
    }

    // 年齢で絞込（入力されていれば）
    if($request->filled('cat_age_from')) {
      $query->where('cat_age', '>=' ,$request->cat_age_from);
    }
    if($request->filled('cat_age_to')) {
      $query->where('cat_age', '<=' ,$request->cat_age_to);
    }

    // [削除対象も含める] にチェックが入っていない場合
    // 削除対象は検索に含めない（将来的に管理者のみの機能に移行）
    if(!$request->with_deleted || !$request->has('with_deleted')) {
      $query->where('cat_status', '!=', 999);
    }

    // 結果を取得（とりあえず1０件）
    $cats = $query->paginate(10);

    // プルダウン用
    // 猫の種類
    $breeds = \App\Models\CatBreed::orderBy('breed_id','asc')->get(['breed_status','breed_name']);
    // ステータス
    $all_statuses = CatStatus::cases();
    // if($request->with_deleted) {
    //   $statuses = $all_statuses;
    // } else {
      $statuses = array_filter($all_statuses, fn($status) => $status->value !== 999);
    // }
    // 猫性別
    $cat_genders = CatGender::cases();

    // ビューに渡す
    return view('cats.index', compact('cats', 'breeds', 'statuses', 'cat_genders'));

    // 参考：以下と同じ
    // return view('cats.index', ['cats' => $cats, 'breeds' => $breeds, 'statuses' => $statuses]);

  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $cat = Cat::findOrFail($id);
    return view('cats.show',compact('cat'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Cat $cat)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Cat $cat)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Cat $cat)
  {
    //
  }
}


/*
TODO:
 猫ステータス 999 は、管理者のみにしか見せない。

*/

/* 参考：


$statuses = array_filter($all_statuses, fn($status) => $status->value !== 999);
上記を省略せずに書くとこうなる
$statuses = array_filter($all_statuses, function($status) {
    return $status->value !== 999;
});

*/