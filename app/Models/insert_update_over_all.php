<?php
namespace App\Models;

use CodeIgniter\Model;

class insert_update_over_all extends Model
{
    protected $DBGroup = 'database_local';
    protected $table = 'influencer';

    public function get_insert_update_over_all($data_update_insert)
    {
        $db = new insert_update_over_all();
        $get_data_table_overall = $db->query("SELECT network,total_post,unique_post
                                                FROM over_all
                                                WHERE  network = '{$data_update_insert['network']}'");

        $get_data_overall = $get_data_table_overall->getResultArray();
        if ($get_data_overall == null) {
            $over_all = new insert_update_over_all();
            $insert_update = $over_all->insert_total_unique_post_over_all($data_update_insert['network'], $data_update_insert['count_total_post']);
        } else {
            $over_all = new insert_update_over_all();
            $update_update = $over_all->update_total_unique_post_over_all($data_update_insert['network'], $get_data_overall[0]['total_post'], $get_data_overall[0]['unique_post'], $data_update_insert['count_unique_post'], $data_update_insert['count_total_post']);
        }
        return $get_data_overall;
    }

    public function update_total_unique_post_over_all($network, $total_post_data_table, $unique_post_data_table, $count_unique_post, $count_total_post)
    {
        $db = new insert_update_over_all();
        $total_post = (int) $total_post_data_table + (int) $count_total_post;
        $unique_post = (int) $unique_post_data_table + (int) $count_unique_post;
        $duplicate = ($total_post - $unique_post) / $total_post;
        $db->query("UPDATE over_all 
                    SET total_post=$total_post,  unique_post = $unique_post,duplicate= $duplicate
                    WHERE  network = '$network'");
    }
    public function insert_total_unique_post_over_all($network, $count_total_post)
    {
        $db = new insert_update_over_all();
        $db->query("INSERT INTO over_all(network,total_post,unique_post)
                    VALUES ('$network',$count_total_post,$count_total_post);");
    }

    public function insert_account($data_account, $follower)
    {
        foreach ($data_account as $value) {
            $network = $value['network'];
            $influencer_profile = $value['influencer_profile'];

            $db = new insert_update_over_all();
            $db->query("UPDATE over_all 
                        SET account=$influencer_profile
                        WHERE  network = '$network'");
        }

        foreach ($follower as $value) {
            $network = $value['network'];
            $follower = $value['follower'];

            $db = new insert_update_over_all();
            $db->query("UPDATE over_all 
            SET follower=$follower
            WHERE  network = '$network'");
        }
    }
}