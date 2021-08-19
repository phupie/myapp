<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Comment;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Comment $comment)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Report $report)
    {
        $user = auth()->user();
        $data = $request->all();
        $gallery_id = $request->gallery_id;
        $validator = Validator::make($data,[
            'name_category' => ['required', 'integer'],
        ]);
        
        $validator->validate();
        $report->reportStore($user->id, $data);
        
        return redirect()->route('user.galleries.show', $gallery_id)->with('flash_message', 'コメントを報告しました。取り消す場合は赤フラッグから取り消してください。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $user_id = $report->user_id;
        $comment_id = $report->comment_id;
        $report_id = $report->id;
        $is_Report = $report->isReport($user_id, $comment_id);
        
        if(isset($is_Report)) {
            $report->reportDestroy($report_id);
            return back();
        }
        
        return back();
    }
}
