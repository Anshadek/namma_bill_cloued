<div class="modal fade " id="service-modal">
                <?= form_open('#', array('class' => '', 'id' => 'service-form','enctype'=>'multipart/form-data', 'method'=>'POST')); ?>
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header header-custom">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title text-center"><?= $this->lang->line('add_service'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="item_name"><?= $this->lang->line('item_name'); ?><span class="text-danger">*</span></label>
                                <span id="item_name_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" class="form-control" id="item_name" name="item_name" placeholder="" >
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="category_id"><?= $this->lang->line('category'); ?><span class="text-danger">*</span></label>
                                <span id="category_id_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control select2" id="category_id" name="category_id"  style="width: 100%;">
                                    <?php
                                       $query1="select * from db_category where status=1";
                                       $q1=$this->db->query($query1);
                                       if($q1->num_rows($q1)>0)
                                        {  echo '<option value="">-Select-</option>'; 
                                            foreach($q1->result() as $res1)
                                          { 
                                            echo "<option value='".$res1->id."'>".$res1->category_name."</option>";
                                          }
                                        }
                                        else
                                        {
                                           ?>
                                    <option value="">No Records Found</option>
                                    <?php
                                       }
                                       ?>
                                 </select>
                              </div>
                            </div>
                          </div>
                          

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="sku"><?= $this->lang->line('hsn/sac'); ?></label>
                                <span id="sku_msg" class="text-danger text-right pull-right"></span>
                                <input type="tel" maxlength="10" class="form-control maxlength " id="sku" name="sku" placeholder=""  >
                              </div>
                            </div>
                          </div>
                          
                          
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="custom_barcode"><?= $this->lang->line('barcode'); ?></label>
                                <span id="custom_barcode_msg" class="text-danger text-right pull-right"></span>
                                <input type="tel" class="form-control maxlength  " id="custom_barcode" name="custom_barcode" placeholder=""  >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="seller_points"><?= $this->lang->line('seller_points'); ?></label>
                                <span id="seller_points_msg" class="text-danger text-right pull-right"></span>
                                <input type="tel" class="form-control maxlength  " id="seller_points" name="seller_points" placeholder=""  >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="description"><?= $this->lang->line('description'); ?></label>
                                <span id="description_msg" class="text-danger text-right pull-right"></span>
                                <textarea class="form-control" id="description" name="description" placeholder="" ></textarea>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <hr>
                        <div class="row">                          
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="discount_type"><?= $this->lang->line('discount_type'); ?></label>
                                <span id="discount_type_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control select2" id="discount_type" name="discount_type"  style="width: 100%;">
                                   <option value='Percentage'>Percentage(%)</option>
                                 <option value='Fixed'>Fixed(<?= $CI->currency() ?>)</option>
                                 </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="discount"><?= $this->lang->line('discount'); ?></label>
                                <span id="discount_msg" class="text-danger text-right pull-right"></span>
                                <input type="tel" class="form-control maxlength no_special_char_no_space " id="discount" name="discount" placeholder=""  >
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">                          

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="price"><?= $this->lang->line('price'); ?><span class="text-danger">*</span></label>
                                <span id="price_msg" style="display:none" class="text-danger"></span>
                                <input type="text" class="form-control only_currency" id="price" name="price" placeholder="Price of Item without Tax">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="tax_id"><?= $this->lang->line('tax'); ?><span class="text-danger">*</span></label>
                                <span id="tax_id_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control select2" id="tax_id" name="tax_id"  style="width: 100%;">
                                    <?php
                                       $query1="select * from db_tax where status=1";
                                       $q1=$this->db->query($query1);
                                       if($q1->num_rows($q1)>0)
                                        {  echo '<option value="">-Select-</option>'; 
                                            foreach($q1->result() as $res1)
                                          { 
                                            echo "<option data-tax='".$res1->tax."' value='".$res1->id."'>".$res1->tax_name."</option>";
                                          }
                                        }
                                        else
                                        {
                                           ?>
                                    <option value="">No Records Found</option>
                                    <?php
                                       }
                                       ?>
                                 </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4 hide">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="purchase_price"><?= $this->lang->line('purchase_price'); ?><span class="text-danger">*</span></label>
                                <span id="price_msg" style="display:none" class="text-danger"></span>
                                <input type="text" class="form-control only_currency" id="purchase_price" name="purchase_price" placeholder="Purchase Price">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="tax_type"><?= $this->lang->line('tax_type'); ?><span class="text-danger">*</span></label>
                                <span id="tax_type_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control select2" id="tax_type" name="tax_type"  style="width: 100%;">
                                   <option value="Inclusive">Inclusive</option>
                                    <option value="Exclusive">Exclusive</option>
                                 </select>
                              </div>
                            </div>
                          </div>


                          

                        

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="sales_price"><?= $this->lang->line('sales_price'); ?><span class="text-danger">*</span></label>
                                <span id="sales_price_msg" class="text-danger text-right pull-right"></span>
                                <input type="tel" maxlength="10" class="form-control maxlength no_special_char_no_space " id="sales_price" name="sales_price" placeholder=""  >
                              </div>
                            </div>
                          </div>
                          

                        
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="item_image"><?= $this->lang->line('select_image'); ?></label>
                                <span id="item_image_msg" style="display:block;" class="text-danger">Max (1000px*1000px),1MB </span>
                                <input type="file" name="item_image" id="item_image">
                              </div>
                            </div>
                          </div>
                          

                        </div>
                       
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="services_bit" value="1">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary add_service">Save</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
               <?= form_close();?>
              </div>
              <!-- /.modal -->