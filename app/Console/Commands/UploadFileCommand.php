<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UploadFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:upload-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $response  = Http::withoutVerifying()->get('https://photoai.cscmobicorp.com/wallapi/get-categories');
        // $data      = json_decode($response->body());
        // $converted = collect($data)->map(function ($item) {
        //     return [
        //         'code' => $item->key,
        //         'name' => $item->name,
        //     ];
        // })->toArray();
        // DB::table('categories')->insert($converted);

        // $response = Http::withoutVerifying()->get('https://app.cscmobicorp.com/uploadfile/files/g10_a25');
        // $data     = json_decode($response->body());
        // $list = $data->data;
        // $listCate = [];
        // foreach ($list as $val) {
        //     $exists = DB::table('categories')->where('code', Str::slug($val->categoryCode))->first();
        //     if (empty($exists)) {
        //         DB::table('categories')->insert([
        //             'name' => trim($val->categoryName),
        //             'code' => Str::slug($val->categoryCode),
        //         ]);
        //     }

        //     ProcessUploadedFile::dispatch($list);
        // }
        $response = Http::withoutVerifying()->get('https://photoai.cscmobicorp.com/wallapi/images?category=all&page=1&pageNumber=20000');
        Log::info($response->body());
        $data = json_decode($response->body());
        $list = $data->images;
        foreach ($list as $val) {
            $exists = DB::table('categories')->where('code', Str::slug($val->category))->first();
            DB::table('images')->insert([
                'category_id'   => $exists->id ?? 0,
                'category_name' => $val->category ?? '',
                'code' => $val->id ?? '',
                'name' => $val->name ?? '',
                'original_image_url' => $val->original_image_url ?? '',
                'thumbnail_image_url' => $val->thumbnail_image_url ?? '',
                'views' => $val->views ?? '',
            ]);
        }
    }
}
