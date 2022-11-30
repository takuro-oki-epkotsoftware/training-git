<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use Illuminate\Paginati\LengthAwarePaginator;
class JobController extends Controller
{
    public function index()
    {
        // 一覧画面
        //   id 降順でレコードセットを取得(Illuminate\Pagination\LengthAwarePaginator)
        $jobs = Job::orderByDesc('id')->paginate(20);
        return view('admin.jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        // 新規画面
        return view('admin.jobs.create');
    }

    public function store(StoreJobRequest $request)
    {
        // 新規登録
        $job = Job::create([
            'name' => $request->name
        ]);
        return redirect(
            route('admin.jobs.show', ['job' => $job])
        )->with('messages.success', '新規登録が完了しました。');
    }

    public function show(Job $job)
    {
        // 詳細画面
        return view('admin.jobs.show', [
            'job' => $job,
        ]);
    }

    public function edit(Job $job)
    {
        // 編集画面
        return view('admin.jobs.edit', [
            'job' => $job,
        ]);
    }

    public function confirm(UpdateJobRequest $request, Job $job)
    {
        // 更新確認画面
        $job->name = $request->name;
        return view('admin.jobs.confirm', [
            'job' => $job,
        ]);
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        // 更新
        $job->name = $request->name;
        $job->update();
        return redirect(
            route('admin.jobs.show', ['job' => $job])
        )->with('messages.success', '更新が完了しました。');
    }

    public function destroy(Job $job)
    {
        // 削除
        $job->delete();
        return redirect(route('admin.jobs.index'));
    }
    public function csv()
    {
        // CSVダウンロード
        //   CSVレコード配列取得
        $csvRecords = self::getJobCsvRecords();

        //   CSVストリームダウンロード
        return self::streamDownloadCsv('jobs.csv', $csvRecords,',');
    }
    public function tsv()
    {
        // tsvダウンロード
        //   tsvレコード配列取得
        $csvRecords = self::getJobCsvRecords();
        //   TSVストリームダウンロード
        return self::streamDownloadCsv('jobs.tsv', $csvRecords,"\t");
        
    }

    private static function getJobCsvRecords(): array
    {
        // id 降順で全レコード取得
        $jobs = Job::orderByDesc('id')->get();

        $csvRecords = [
            ['ID', '名称'], // ヘッダー
        ];
        foreach ($jobs as $job) {
            $csvRecords[] = [$job->id, $job->name]; // レコード
        }
        return $csvRecords;
    }
    

    private static function streamDownloadCsv(
        string $name,
        iterable $fieldsList,
        string $separator ,
        string $enclosure = '"',
        string $escape = "\\",
        string $eol = "\r\n"
    ) {
        // Content-Type
        $contentType = 'text/plain'; // テキストファイル
        if ($separator === ',') {
            $contentType = 'text/csv'; // CSVファイル
        } elseif ($separator === "\t") {
            $contentType = 'text/tab-separated-values'; // TSVファイル
        }
        $headers = ['Content-Type' => $contentType];

        return response()->streamDownload(function () use ($fieldsList, $separator, $enclosure, $escape, $eol) {
            $stream = fopen('php://output', 'w');
            foreach ($fieldsList as $fields) {
                fputcsv($stream, $fields, $separator, $enclosure, $escape, $eol);
            }
            fclose($stream);
        }, $name, $headers);
    }
}