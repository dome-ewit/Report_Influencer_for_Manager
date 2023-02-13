<?php

namespace App\Libraries;

use App\Models\select_insert_update_unique_post;

class check_unique_id_post
{
   public function check_unique($get_value)
   {
      $json_decode_rawdata = json_decode($get_value['rawdata']);
      if (!is_array($json_decode_rawdata)) {
         $json_decode_rawdata = [];
      }

      $push_id_post = array();
      foreach ($json_decode_rawdata as $value) {
         array_push($push_id_post, strval($value->id_post));
      }

      $select_function_Indatabase = new select_insert_update_unique_post();

      //โพสต์ใหม่ เตรียมเอามาเมิส
      if (!is_array($push_id_post)) {
         $push_id_post = [];
      }

      $check_value = $select_function_Indatabase->get_id_post_database($get_value['influencer_id'], $get_value['network']);
      
      $post_unique_database = array();
      if (!empty($check_value[0]['network'])) {
         $post_unique_database = json_decode($check_value[0]['network']);
      } else {
         $post_unique_database = [];
      }

      if (!is_array($post_unique_database)) {
         $post_unique_database = [];
      }

      $array_merge = array_merge($post_unique_database, $push_id_post);
      $array_unique = array_unique($array_merge);
      $count_total_post = count($push_id_post); //นับโพสต์ที่เข้ามาใหม่ แล้วเอวไปบวกในตาราง ตรง total_post
      $count_post_unique_database = count($post_unique_database); //นับโพสต์ที่ดึงออกมาจากตาราง
      $count_array_unique = count($array_unique); //นับโพสต์ที่uniqueแล้ว
      $count_unique_post = $count_array_unique - $count_post_unique_database; //ค่าที่จะบวกเข้าไปในtable week month overall ตรงpost_unique
      $encode_unique = $array_unique; // โพสต์ที่ unique เตรียม insert เข้าตาราง



      $results_uniqueinsert['count_unique_post'] = $count_unique_post; //เลขที่จะเอาไปบวกunique
      $results_uniqueinsert['count_total_post'] = $count_total_post; //โพสเข้ามาใหม่
      $results_uniqueinsert['encode_unique'] = $encode_unique;
      $results_uniqueinsert['influencer_id'] = $get_value['influencer_id'];
      $results_uniqueinsert['network'] = $get_value['network'];
      $results_uniqueinsert['week'] = $get_value['week'];
      $results_uniqueinsert['year'] = $get_value['year'];
      $results_uniqueinsert['month'] = $get_value['month'];
      $results_uniqueinsert['day'] = $get_value['day'];


      $select_function_Indatabase->insert_unique_post($results_uniqueinsert);

      return $results_uniqueinsert;
   }
}