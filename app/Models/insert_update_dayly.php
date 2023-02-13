<?php

namespace App\Models;

use CodeIgniter\Model;

class insert_update_dayly extends Model
{

    protected $DBGroup = 'database_local';
    protected $table = 'influencer';

    public function select_insert_update_dayly($data_update_insert)
    {

        $db = new insert_update_dayly();
        $select_data_table_dayly = $db->query("SELECT day,month,year,network,total_post,unique_post
        FROM dayly
        WHERE day = '{$data_update_insert['day']}' AND month = '{$data_update_insert['month']}' AND year='{$data_update_insert['year']}' AND network = '{$data_update_insert['network']}'");

        $select_data_dayly = $select_data_table_dayly->getResultArray();
        if ($select_data_dayly == null) {
            $dayly = new insert_update_dayly();
            $dayly->insert_total_unique_post_dayly($data_update_insert['year'], $data_update_insert['month'], $data_update_insert['day'], $data_update_insert['network'], $data_update_insert['count_total_post']);
        } else {
            $dayly = new insert_update_dayly();

            $dayly->update_total_unique_post_dayly($data_update_insert['year'], $data_update_insert['month'], $data_update_insert['day'], $data_update_insert['network'], $select_data_dayly[0]['total_post'], $select_data_dayly[0]['unique_post'], $data_update_insert['count_unique_post'], $data_update_insert['count_total_post']);
        }
    }

    public function update_total_unique_post_dayly($year, $month, $day, $network, $total_post_data_table, $unique_post_data_table, $count_unique_post, $count_total_post)
    {
        $db = new insert_update_dayly();
        $total_post = (int) $total_post_data_table + (int) $count_total_post;
        $unique_post = (int) $unique_post_data_table + (int) $count_unique_post;
        $duplicate = ($total_post - $unique_post) / $total_post;
        $db->query("UPDATE dayly 
                    SET total_post=$total_post,  unique_post = $unique_post,duplicate= $duplicate
                    WHERE day = $day AND month =$month AND year= $year AND network = '$network'");
    }
    public function insert_total_unique_post_dayly($year, $month, $day, $network, $count_total_post)
    {
        $db = new insert_update_dayly();
        $db->query("INSERT INTO dayly(day,month,year,network,total_post,unique_post)
                    VALUES ($day,$month,$year,'$network',$count_total_post,$count_total_post);");
    }

    public function insert_account_day($data_account, $follower)
    {
        foreach ($data_account as $value) {
            $db = new insert_update_dayly();
            $db->query("UPDATE dayly 
                        SET account={$value['influencer_profile']}
                        WHERE year = {$value['year']} AND  month= {$value['month']} AND day = {$value['day']} AND   network = '{$value['network']}' ");
        }

        foreach ($follower as $value) {
            $db = new insert_update_dayly();
            $db->query("UPDATE dayly 
                        SET follower={$value['follower']}
                        WHERE day = {$value['day']} AND month={$value['month']} AND year = {$value['year']} AND  network = '{$value['network']}'");
        }
    }
}