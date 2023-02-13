<?php
namespace App\Models;

use CodeIgniter\Model;

class select_insert_update_unique_post extends Model
{
    protected $DBGroup = 'database_local';
    protected $table = 'influencer';

    public function get_id_post_database($influencer_id, $network)
    {
        $db = new select_insert_update_unique_post();
        $query_get_data = $db->query("SELECT influencer_id,{$network} as network
        FROM post_unique
        where influencer_id = $influencer_id  ");

        $results_data_id_post = $query_get_data->getResultArray();
        return $results_data_id_post;
    }

    public function insert_unique_post($results_uniqueinsert)
    {
        $network = $results_uniqueinsert['network'];
        $influencer_id = $results_uniqueinsert['influencer_id'];
        $encode_unique = json_encode($results_uniqueinsert['encode_unique']);

        $db = new select_insert_update_unique_post();
        $db->query("INSERT INTO post_unique (influencer_id,$network) 
                    VALUES ($influencer_id,'$encode_unique')
                    ON DUPLICATE KEY UPDATE $network='$encode_unique';");

    }
}