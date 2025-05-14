<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessUploadedFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $list = $this->data;
        foreach ($list as $val) {
            $exists = DB::table('categories')->where('code', Str::slug($val->categoryCode))->first();

            foreach ($val->files as $item) {
                DB::table('files')->insert([
                    'original' => json_encode($item->original),
                    'thumbnail' => json_encode($item->thumbnail),
                    'category_id' => $exists->id ?? 0,
                    'category_name' => $val->categoryName ?? '',
                    'category_code' => $val->categoryCode ?? '',
                ]);
            }
        }
    }
}
