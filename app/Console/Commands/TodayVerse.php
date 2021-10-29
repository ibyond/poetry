<?php

namespace App\Console\Commands;

use App\Models\Verse;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\TodayVerse as Today;

class TodayVerse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'today:verse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成今日名句的计划';

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
     */
    public function handle()
    {
        $this->info('开始生成今日名句计划');//每天0点生成
        $form = Today::query()->orderBy('time', 'desc')->first();

        $today = Carbon::today()->toDateString();
        $tomorrow = Carbon::tomorrow()->toDateString();
        if ($form) {
            if ($form->time == $today) { //找到今天的名句，生成明天的
                $this->createTodayVerse($tomorrow);
                $this->info('生成今日名句计划:' . $tomorrow);
            } elseif($form->time >= $tomorrow){//找到明天的，不用生成
                $this->info('不用生成今日名句计划');
            } else {//找到小于今日的名句，补充生成其中的空缺
                // todo 找到小于今日的名句，补充生成其中的空缺
            }
        } else {//刚才开始，生成一个月前的和今天和明天
            $todays = Carbon::today();
            $days = $todays->diffInDays($todays->copy()->subMonth());
            //生成今日之前一个月内
            for ($i = $days; $i >= 1; $i--) {
                $date = $todays->copy()->sub($i . ' day');
                $exists = Today::query()->where('time',$date->copy()->toDateString())->exists();
                if ($exists) {
                    continue;
                }
                $this->createTodayVerse($date);
                $this->info('生成今日名句计划:' . $date);
            }
            //生成今日
            $this->createTodayVerse($today);
            $this->info('生成今日名句计划:' . $today);
            //生成明日
            $this->createTodayVerse($tomorrow);
            $this->info('生成明日名句计划:' . $tomorrow);
        }
    }

    public function getRandVerse() : int
    {
        $last = Verse::query()->select('id')->where('status', Verse::STATUS_NORMAL)->orderBy('id', 'desc')->first();
        $verse_id = 1;
        for ($i = 0; $i < 100; $i++) {
            $verse_id = mt_rand(1, $last->id);
            $verse = Verse::query()->where('id', $verse_id)->where('status', Verse::STATUS_NORMAL)->first();
            if ($verse) {
                break;
            }
        }
        return $verse_id;
    }

    protected function createTodayVerse($time = '')
    {
        $verse = new Today();
        $verse->verse_id = $this->getRandVerse();
        $verse->time = $time;
        $verse->save();
    }
}
