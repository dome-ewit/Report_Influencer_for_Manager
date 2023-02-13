<?php
namespace App\Models;

use CodeIgniter\Model;

class insert_update_weekly extends Model
{
    protected $DBGroup = 'database_local';
    protected $table = 'influencer';

    public function get_insert_update_weekly($data_update_insert)
    {
        $db = new insert_update_weekly();
        $get_data_table_weekly = $db->query("SELECT week,year,network,total_post,unique_post
        FROM weekly
        WHERE week = '{$data_update_insert['week']}' AND year='{$data_update_insert['year']}' AND network = '{$data_update_insert['network']}'");

        $get_data_weekly = $get_data_table_weekly->getResultArray();
        if ($get_data_weekly == null) {
            $weekly = new insert_update_weekly();
            $weekly->insert_total_unique_post_weekly($data_update_insert['year'], $data_update_insert['week'], $data_update_insert['network'], $data_update_insert['count_total_post']);
        } else {
            $weekly = new insert_update_weekly();
            $total_post_data_table = $get_data_weekly[0]['total_post'];
            $unique_post_data_table = $get_data_weekly[0]['unique_post'];
            $weekly->update_total_unique_post_weekly($data_update_insert['year'], $data_update_insert['week'], $data_update_insert['network'], $total_post_data_table, $unique_post_data_table, $data_update_insert['count_unique_post'], $data_update_insert['count_total_post']);
        }
    }

    public function update_total_unique_post_weekly($year, $week, $network, $total_post_data_table, $unique_post_data_table, $count_unique_post, $count_total_post)
    {
        $db = new insert_update_weekly();
        $total_post = (int) $total_post_data_table + (int) $count_total_post;
        $unique_post = (int) $unique_post_data_table + (int) $count_unique_post;
        $duplicate = ($total_post - $unique_post) / $total_post;
        $db->query("UPDATE weekly 
                    SET total_post=$total_post,  unique_post = $unique_post,duplicate= $duplicate
                    WHERE week =$week AND year= $year AND network = '$network'");
    }
    public function insert_total_unique_post_weekly($year, $week, $network, $count_total_post)
    {
        $db = new insert_update_weekly();
        $db->query("INSERT INTO weekly(week,year,network,total_post,unique_post)
                    VALUES ($week,$year,'$network',$count_total_post,$count_total_post);");
    }

    public function insert_account_week($data_account, $follower)
    {
        foreach ($data_account as $value) {

            $db = new insert_update_weekly();
            $db->query("UPDATE weekly 
                        SET account={$value['influencer_profile']}
                        WHERE year = {$value['year']} AND week= {$value['week']} AND  network = '{$value['network']}' ");
        }
        foreach ($follower as $value) {

            $db = new insert_update_weekly();
            $db->query("UPDATE weekly 
                        SET follower={$value['follower']}
                        WHERE year = {$value['year']} AND week= {$value['week']} AND  network = '{$value['network']}' ");

        }

    }


}