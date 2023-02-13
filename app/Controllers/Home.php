<?php
namespace App\Controllers;

use App\Models\select_data;
use App\Libraries\check_unique_id_post;
use App\Models\insert_update_over_all;
use App\Models\insert_update_weekly;
use App\Models\insert_update_monthly;
use App\Models\insert_update_dayly;
use App\Models\last_id;

class Home extends BaseController
{
    public function index()
    {
        ini_set('max_execution_time', 0);
        $insert_value_overall = new insert_update_over_all();
        $insert_value_weekly = new insert_update_weekly();
        $insert_value_monthly = new insert_update_monthly();
        $insert_value_dayly = new insert_update_dayly();
        $count = new select_data();
        $count_id = $count->count_id();
        $data_select = new select_data();

        // while ((int) $count_id > 1000) {

        $data = $data_select->query63();
        foreach ($data as $value) {
            $check_unique = new check_unique_id_post();
            $data_update_insert = $check_unique->check_unique($value); //เก็บข้อมูล post unique ลง database
            $insert_value_dayly->select_insert_update_dayly($data_update_insert);
            $insert_value_monthly->select_insert_update_monthly($data_update_insert);
            $insert_value_overall->select_insert_update_over_all($data_update_insert);
            $insert_value_weekly->select_insert_update_weekly($data_update_insert);

            $last_id = new last_id();
            $last_id->update_last_id($value);

            $format_month = $value['format_month'];
            $format_week = $value['format_week'];
            $format_day = $value['format_day'];
            $array_month[$format_month] = $format_month;
            $array_week[$format_week] = $format_week;
            $array_day[$format_day] = $format_day;
        }

        $influencer_account_monthly = implode(",", $array_month);
        $influencer_account_weekly = implode(",", $array_week);
        $influencer_account_dayly = implode(",", $array_day);

        #Overall
        $influencer_account_overall = $data_select->influencer_account_overall();
        $influencer_counting_account_over_all = $influencer_account_overall['influencer_counting_account'];
        $counting_follower_over_all = $influencer_account_overall['follower'];
        $insert_value_overall->insert_account($influencer_counting_account_over_all, $counting_follower_over_all); //เก็บข้อมูล post unique ลง database

        #Weekly
        $account_weekly = $data_select->influencer_account_week($influencer_account_weekly);
        $influencer_counting_account_week = $account_weekly['influencer_counting_account'];
        $counting_follower_week = $account_weekly['follower'];
        $insert_value_weekly->insert_account_week($influencer_counting_account_week, $counting_follower_week); //เก็บข้อมูล post unique ลง database

        #Monthly
        $account_monthly = $data_select->influencer_account_month($influencer_account_monthly);
        $influencer_counting_account_month = $account_monthly['influencer_counting_account'];
        $counting_follower_month = $account_monthly['follower'];
        $insert_value_monthly->insert_account_month($influencer_counting_account_month, $counting_follower_month); //เก็บข้อมูล post unique ลง database

        #Day
        $account_dayly = $data_select->influencer_account_day($influencer_account_dayly);
        $influencer_counting_account_day = $account_dayly['influencer_counting_account'];
        $counting_follower_day = $account_dayly['follower'];
        $insert_value_dayly->insert_account_day($influencer_counting_account_day, $counting_follower_day); //เก็บข้อมูล post unique ลง database
        // }
    }
}