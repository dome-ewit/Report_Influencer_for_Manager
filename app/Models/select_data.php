<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Models\last_id;

class select_data extends Model
{
    protected $DBGroup = 'database_63';
    protected $table = 'influencer';

    public function count_id()
    {
        $db = new select_data();
        $last = new last_id();
        $last_id = $last->get_last_id();
        $count_data = $db->query("SELECT count(id) countID
        FROM influencer_stat_post_recent_intern
        WHERE id > $last_id ");
        $count_data = $count_data->getResultArray();
        return $count_data[0]['countID'];
    }
    public function query63()
    {
        $db = new select_data();
        $last_id_data = new last_id();
        $last_id = $last_id_data->get_last_id();

        $database_63 = $db->query("SELECT id,influencer_id,network,create_date,
        rawdata,follower,week(create_date) AS week,month(create_date) AS month,year(create_date) AS year,day(create_date) AS day
        ,DATE_FORMAT(create_date, '%Y%m') format_month
        ,DATE_FORMAT(create_date, '%Y%m%d') format_day
        ,DATE_FORMAT(create_date, '%Y%U') format_week
        FROM influencer_stat_post_recent_intern
        WHERE id > $last_id
        ORDER BY id ASC 
        LIMIT 0,1000");

        $results63 = $database_63->getResultArray();
        return $results63;
    }

    public function influencer_account_overall()
    {
        $db = new select_data();

        #Count_influencer_profile
        $influencer_counting_account = $db->query("SELECT network,COUNT(DISTINCT influencer_id) influencer_profile  FROM influencer_stat_post_recent_intern
        GROUP BY network;
        ");

        #Count_influencer_profile Follower >= 2500
        $counting_follower = $db->query("SELECT COUNT(DISTINCT influencer_id) follower ,network FROM influencer_stat_post_recent_intern
        WHERE  follower >= 2500
        GROUP BY network;
        ");

        $results63['influencer_counting_account'] = $influencer_counting_account->getResultArray();
        $results63['follower'] = $counting_follower->getResultArray();
        return $results63;
    }

    public function influencer_account_week($influencer_account_weekly)
    {
        $db = new select_data();

        #Count_influencer_profile Group by Week
        $influencer_counting_account = $db->query("SELECT count(distinct influencer_id) influencer_profile, network,WEEK(create_date) week,YEAR(create_date) year FROM influencer_stat_post_recent_intern
        WHERE DATE_FORMAT(create_date, '%Y%U') IN ($influencer_account_weekly)
        GROUP BY YEAR(create_date),WEEK(create_date),network;
        ");

        #Count_influencer_profile Follower >= 2500 Group by Week
        $counting_follower = $db->query("SELECT count(distinct influencer_id) follower, network,WEEK(create_date) week,YEAR(create_date) year FROM influencer_stat_post_recent_intern
        WHERE DATE_FORMAT(create_date, '%Y%U') IN ($influencer_account_weekly) AND follower >= 2500
        GROUP BY YEAR(create_date),WEEK(create_date),network;
        ");

        $results63['influencer_counting_account'] = $influencer_counting_account->getResultArray();
        $results63['follower'] = $counting_follower->getResultArray();
        return $results63;
    }

    public function influencer_account_month($influencer_account_monthly)
    {
        $db = new select_data();

        #Count_influencer_profile Group by Month
        $influencer_counting_account = $db->query("SELECT count(distinct influencer_id) influencer_profile, network,MONTH(create_date) month,YEAR(create_date) year FROM influencer_stat_post_recent_intern
        WHERE DATE_FORMAT(create_date, '%Y%m') IN ($influencer_account_monthly)
        GROUP BY YEAR(create_date),month(create_date),network;
        ");

        #Count_influencer_profile Follower >= 2500 Group by Month
        $counting_follower = $db->query("SELECT count(distinct influencer_id) follower, network,MONTH(create_date) month,YEAR(create_date) year FROM influencer_stat_post_recent_intern
        WHERE DATE_FORMAT(create_date, '%Y%m') IN ($influencer_account_monthly) AND follower >= 2500
        GROUP BY YEAR(create_date),month(create_date),network;
        ");

        $results63['influencer_counting_account'] = $influencer_counting_account->getResultArray();
        $results63['follower'] = $counting_follower->getResultArray();
        return $results63;
    }

    public function influencer_account_day($influencer_account_dayly)
    {
        $db = new select_data();

        #Count_influencer_profile Group by Day
        $influencer_counting_account = $db->query("SELECT count(distinct influencer_id) influencer_profile, network,day(create_date) day,MONTH(create_date) month,YEAR(create_date) year FROM influencer_stat_post_recent_intern
        WHERE DATE_FORMAT(create_date, '%Y%m%d') IN ($influencer_account_dayly)
        GROUP BY YEAR(create_date),month(create_date),day(create_date),network;
        ");

        #Count_influencer_profile Follower >= 2500 Group by Day
        $counting_follower = $db->query("SELECT count(distinct influencer_id) follower, network,day(create_date) day,MONTH(create_date) month,YEAR(create_date) year FROM influencer_stat_post_recent_intern
        WHERE  follower >= 2500 AND DATE_FORMAT(create_date, '%Y%m%d') IN ($influencer_account_dayly)
        GROUP BY YEAR(create_date),month(create_date),day(create_date),network;
        ");

        $results63['influencer_counting_account'] = $influencer_counting_account->getResultArray();
        $results63['follower'] = $counting_follower->getResultArray();
        return $results63;
    }






}