<?php

class Subject_Model extends MY_Model {

    const DB_TABLE = 'tbl_subject';
    const DB_TABLE_PK = 'subject_id';

    /*

    offer id -      tbl_grade_section ----- section
    subj_id         tbl_subject
    subj_offerid    tbl_subj_offering

    */

    /* get */
    /*public function get_subjects(){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql  = "SELECT DISTINCT 
              (a.subj_id),
              a.*,
              b.*,
              c.* 
            FROM
              tbl_subject a,
              tbl_grade_subj b,
              tbl_grade_level c 
            WHERE a.subj_id = b.`subj_id` 
              AND b.`gl_id` = c.`gl_id` ";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }*/

    public function get_assigned_subjects(){
      
      $sql = "SELECT 
          * 
        FROM
          tbl_subject a,
          tbl_grade_subj b,
          tbl_grade_level c
        WHERE a.subj_id = b.`subj_id` 
        AND b.`gl_id` = c.`gl_id`";

      $query = $this->db->query($sql);

      $result = $query->result();

      return $result;
    }

    public function get_subjects(){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql  = "SELECT DISTINCT 
              (a.subj_id), a.*
            FROM
              tbl_subject a";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_subjects_not_assigned_by_school_year_and_year_level($sy_start, $sy_end, $year_level){

      $sql = "SELECT 
          * 
        FROM
          tbl_subject 
        WHERE year_level = ? AND subj_id NOT IN 
          (SELECT DISTINCT 
            (a.`subj_id`) 
          FROM
            tbl_grade_subj a,
            tbl_grade_level b 
          WHERE b.`sy_start` = ?
            AND b.`sy_end` = ? 
            AND b.grade_level = ?
            AND a.gl_id = b.gl_id)";

      $escaped_values = array($year_level, $sy_start, $sy_end, $year_level);

      $query = $this->db->query($sql, $escaped_values);

      $result = $query->result();

      return $result;

    }

    public function get_subjects_by_school_year_and_grade_level($sy_start, $sy_end, $grade_level){

      $sql = "SELECT DISTINCT 
          (a.subj_id),
          a.*,
          b.*,
          c.* 
        FROM
          tbl_subject a,
          tbl_grade_subj b,
          tbl_grade_level c 
        WHERE a.subj_id = b.`subj_id` 
          AND b.`gl_id` = c.`gl_id`";

        if(($sy_start != null) && ($sy_end != null)){
          $sql .= " AND c.`sy_start` = ?
          AND c.`sy_end` = ? ";
        }

        if($grade_level != null && $grade_level != ''){
          $sql .= " AND c.`grade_level` = ?";
        }


        if($sy_start != '' && $sy_end != '' && $grade_level != ''){
          $escaped_values = array($sy_start, $sy_end, $grade_level);
        }else if($grade_level == null || $grade_level == ''){
          $escaped_values = array($sy_start, $sy_end);
        }else{
          $escaped_values = array($grade_level);
        }
          

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;

    }

    public function get_offered_subjects($offer_id){ //section

        $sql = "SELECT * FROM tbl_subj_offering a, tbl_subject b WHERE a.offer_id = ? AND b.subj_id = a.subj_id";

        $escaped_values = array($offer_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_subjects_with_no_grade_level(){

        $sql = "SELECT 
          * 
        FROM
          tbl_subject 
        WHERE subj_id NOT IN 
          (SELECT 
            a.subj_id 
          FROM
            tbl_subject a,
            tbl_grade_level b,
            tbl_grade_subj c 
          WHERE b.`gl_id` = c.`gl_id` 
            AND a.`subj_id` = c.`subj_id`)";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_subjects_with_grade_level(){

        $sql = "SELECT 
            DISTINCT(a.subj_id),
            a.*,
            b.*,
            c.* 
          FROM
            tbl_subject a,
            tbl_grade_level b,
            tbl_grade_subj c 
          WHERE b.`gl_id` = c.`gl_id` 
            AND a.`subj_id` = c.`subj_id`";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    /* count */
    public function count_subject_by_grade_level($sy_start, $sy_end, $grade_level, $subj_code){

        $sql = "SELECT 
          COUNT(DISTINCT(c.subj_id)) AS count_subject
        FROM
          tbl_subject a,
          tbl_grade_level b,
          tbl_grade_subj c 
        WHERE a.subj_code LIKE '%{$subj_code}%'
          AND b.grade_level = ? 
          AND b.sy_start = ? 
          AND b.`sy_end` = ? 
          AND b.`gl_id` = c.`gl_id`
          AND a.subj_id = c.`subj_id`";

        $escaped_values = array($grade_level, $sy_start, $sy_end);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count_subject;

        return $result;
    }


    public function get_subjects_by_year_level($year_level){

      $sql = "SELECT 
          * FROM
          tbl_subject a 
        WHERE a.year_level = ?";

      $escaped_values = array($year_level);

      $query = $this->db->query($sql, $escaped_values);

      $result = $query->result();

      return $result;

    }


    public function count_subject_by_year_level($year_level, $subj_code){

        $sql = "SELECT 
          COUNT(DISTINCT (a.`subj_id`)) AS count_subject 
        FROM
          tbl_subject a 
        WHERE a.subj_code LIKE '%{$subj_code}%' 
          AND a.year_level = ?";

        $escaped_values = array($year_level);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count_subject;

        return $result;
    }

    /* create */
    public function create_subject($subject_code, $subject_unit, $subject_description, $year_level){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (subj_code, subj_unit, subj_desc, year_level) VALUES (?, ?, ?, ?)";

        $escaped_values = array($subject_code, $subject_unit, $subject_description, $year_level);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function add_subject_grade_level($subj_id, $grade_level){

        $sql = "INSERT INTO tbl_grade_subj (subj_id, gl_id) VALUES (?, ?)";

        $escaped_values = array($subj_id, $grade_level);

        $query = $this->db->query($sql, $escaped_values);
    }

    public function get_subj_offerid_by_subject($subj_id){

         $sql = "SELECT subj_offerid FROM subj_offering WHERE subj_id = ?";

         $escaped_values = array($subj_id);

         $query = $this->db->query($sql, $escaped_values);

         $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->subj_offerid;
        }else {
            $result = 0;
        }

        return $result;
    }

    //delete


    public function remove_subject($id){

        $sql = "DELETE FROM tbl_subject WHERE subj_id = ?";

        $escaped_values = array($id);

        $query = $this->db->query($sql, $escaped_values);
    }

    //update
    public function update_subject($id, $subj_code, $subj_desc, $unit){

        $sql = "UPDATE tbl_subject SET subj_code = ?, subj_desc = ?, subj_unit = ? WHERE subj_id = ?";

        $escaped_values = array($subj_code, $subj_desc, $unit, $id);

        $query = $this->db->query($sql, $escaped_values);

        return $id;
    }


    


}

?>
