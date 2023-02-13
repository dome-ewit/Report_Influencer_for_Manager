<?php
namespace App\Models;

use CodeIgniter\Model;

class insert_update_monthly extends Model
{
    protected $DBGroup = 'database_local';
    protected $table = 'influencer';

    public function get_insert_update_monthly($data_update_insert)
    {
        $db = new insert_update_monthly();
        $get_data_table_monthly = $db->query("SELECT month,year,network,total_post,unique_post
                                                FROM monthly
                                                WHERE month = '{$data_update_insert['month']}' AND year='{$data_update_insert['year']}' AND network = '{$data_update_insert['network']}'");

        $get_data_monthly = $get_data_table_monthly->getResultArray();
        if ($get_data_monthly == null) {
            $monthly = new insert_update_monthly();
            $monthly->insert_total_unique_post_monthly($data_update_insert['year'], $data_update_insert['month'], $data_update_insert['network'], $data_update_insert['count_total_post']);
        } else {
            $monthly = new insert_update_monthly();
            $monthly->update_total_unique_post_monthly($data_update_insert['year'], $data_update_insert['month'], $data_update_insert['network'], $get_data_monthly[0]['total_post'], $get_data_monthly[0]['unique_post'], $data_update_insert['count_unique_post'], $data_update_insert['count_total_post']);
        }

    }

    public function update_total_unique_post_monthly($year, $month, $network, $total_post_data_table, $unique_post_data_table, $count_unique_post, $count_total_post)
    {
        $db = new insert_update_monthly();
        $total_post = (int) $total_post_data_table + (int) $count_total_post;
        $unique_post = (int) $unique_post_data_table + (int) $count_unique_post;
        $duplicate = ($total_post - $unique_post) / $total_post;
        $db->query("UPDATE monthly 
                    SET total_post=$total_post,  unique_post = $unique_post,duplicate= $duplicate
                    WHERE month =$month AND year= $year AND network = '$network'");
    }
    public function insert_total_unique_post_monthly($year, $month, $network, $count_total_post)
    {
        $db = new insert_update_monthly();
        $db->query("INSERT INTO monthly(month,year,network,total_post,unique_post)
                    VALUES ($month,$year,'$network',$count_total_post,$count_total_post);");
    }

    public function insert_account_month($data_account, $follower)
    {
        foreach ($data_account as $value) {

            $db = new insert_update_dayly();
            $db->query("UPDATE monthly 
                        SET account={$value['influencer_profile']}
                        WHERE year = {$value['year']} AND  month= {$value['month']}  AND   network = '{$value['network']}' ");
        }

        foreach ($follower as $value) {
            $db = new insert_update_dayly();
            $db->query("UPDATE monthly 
                        SET follower={$value['follower']}
                        WHERE month={$value['month']} AND year = {$value['year']} AND  network = '{$value['network']}'");
        }
    }
}