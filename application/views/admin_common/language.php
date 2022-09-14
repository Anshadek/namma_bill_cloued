<div class="row">
    <div class="col-md-12">
      <div class="form-group col-md-2 col-xs-6">
          <select class="form-control input-sm language_id" style="margin: 10px;">
            <?php $lang_query=$this->db->query('select * from db_languages where status=1  order by language asc');
                  $my_language = (!empty($this->session->userdata('language')) ) ? 
                                              $this->session->userdata('language') : "English";

                  foreach ($lang_query->result() as $res) {
                    $selected = ($my_language == $res->language) ? "selected" : "";
                    echo "<option $selected value='".$res->id."'>".$res->language."</option>";
                  }?>
          </select>
      </div>
    </div>
  </div>