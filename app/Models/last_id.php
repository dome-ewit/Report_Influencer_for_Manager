<?php
namespace App\Models;

use CodeIgniter\Model;

class last_id extends Model
{
    protected $DBGroup = 'database_local';
    protected $table = 'influencer';

    public function select_last_id()
    {
        $db = new last_id();
        $last_id = $db->query("SELECT last_id FROM stat_running_log");
        $last_id = $last_id->getResultArray();
        return $last_id[0]['last_id'];
    }

    public function update_last_id($row)
    {
        $id = $row['id'];
        $db = new last_id();
        $db->query("UPDATE stat_running_log 
                    SET last_id='$id',last_running = CURRENT_TIMESTAMP
                    WHERE id = '1'");
    }
}