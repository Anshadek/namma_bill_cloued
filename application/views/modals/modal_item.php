<?php $CI =& get_instance(); ?>
<div class="modal fade " id="item-modal">
                <?= form_open('#', array('class' => '', 'id' => 'item-form','enctype'=>'multipart/form-data', 'method'=>'POST')); ?>
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header header-custom">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title text-center"><?= $this->lang->line('new_item'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_item_name"><?= $this->lang->line('item_name'); ?><span class="text-danger">*</span></label>
                                <span id="m_item_name_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" class="form-control" id="m_item_name" name="m_item_name" placeholder="" >
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_brand"><?= $this->lang->line('brand'); ?></label>
                                <span id="m_brand_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control " id="m_brand_id" name="m_brand_id"  style="width: 100%;"  >
                                    <?php
                                       $query1="select * from db_brands where status=1";
                                       $q1=$this->db->query($query1);
                                       if($q1->num_rows($q1)>0)
                                        {  echo '<option value="">-Select-</option>'; 
                                            foreach($q1->result() as $res1)
                                          { 
                                            echo "<option value='".$res1->id."'>".$res1->brand_name."</option>";
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
                                <label for="m_category_id"><?= $this->lang->line('category'); ?><span class="text-danger">*</span></label>
                                <span id="m_category_id_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control " id="m_category_id" name="m_category_id"  style="width: 100%;">
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
                                <label for="m_unit_id"><?= $this->lang->line('unit'); ?><span class="text-danger">*</span></label>
                                <span id="m_unit_id_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control " id="m_unit_id" name="m_unit_id"  style="width: 100%;">
                                    <?php
                                       $query1="select * from db_units where status=1";
                                       $q1=$this->db->query($query1);
                                       if($q1->num_rows($q1)>0)
                                        {  echo '<option value="">-Select-</option>'; 
                                            foreach($q1->result() as $res1)
                                          { 
                                            echo "<option value='".$res1->id."'>".$res1->unit_name."</option>";
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
                                <label for="m_hsn"><?= $this->lang->line('hsn'); ?></label>
                                <span id="m_hsn_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" class="form-control maxlength " id="m_hsn" name="m_hsn" placeholder=""  >
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_sku"><?= $this->lang->line('sku'); ?></label>
                                <span id="m_sku_msg" class="text-danger text-right pull-right"></span>
                                <input type="text"  class="form-control maxlength " id="m_sku" name="m_sku" placeholder=""  >
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_alert_qty"><?= $this->lang->line('alert_qty'); ?></label>
                                <span id="m_alert_qty_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" maxlength="10" class="form-control maxlength no_special_char_no_space " id="m_alert_qty" name="m_alert_qty" placeholder=""  >
                              </div>
                            </div>
                          </div>
                        
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_seller_points"><?= $this->lang->line('seller_points'); ?></label>
                                <span id="m_seller_points_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" maxlength="10" class="form-control maxlength  " id="m_seller_points" name="m_seller_points" placeholder=""  >
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_custom_barcode"><?= $this->lang->line('barcode'); ?></label>
                                <span id="m_custom_barcode_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" class="form-control maxlength  " id="m_custom_barcode" name="m_custom_barcode" placeholder=""  >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4 hide">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_item_group"><?= $this->lang->line('item_group'); ?><span class="text-danger">*</span></label>
                                <span id="m_item_group_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control " id="m_item_group" name="m_item_group"  style="width: 100%;">
                                    <option  value="Single">Single</option>
                                    <option  value="Variants">Variants</option>
                                 </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_description"><?= $this->lang->line('description'); ?></label>
                                <span id="m_description_msg" class="text-danger text-right pull-right"></span>
                                <textarea class="form-control" id="m_description" name="m_description" placeholder="" ></textarea>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <hr>
                        <div class="row">                          
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_discount_type"><?= $this->lang->line('discount_type'); ?></label>
                                <span id="m_discount_type_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control " id="m_discount_type" name="m_discount_type"  style="width: 100%;">
                                   <option value='Percentage'>Percentage(%)</option>
                                 <option value='Fixed'>Fixed(<?= $CI->currency() ?>)</option>
                                 </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_discount"><?= $this->lang->line('discount'); ?></label>
                                <span id="m_discount_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" class="form-control maxlength no_special_char_no_space " id="m_discount" name="m_discount" placeholder=""  >
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">                          

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_price"><?= $this->lang->line('price'); ?><span class="text-danger">*</span></label>
                                <span id="m_price_msg" style="display:none" class="text-danger"></span>
                                <input type="text" class="form-control only_currency" id="m_price" name="m_price" placeholder="Price of Item without Tax">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_tax_id"><?= $this->lang->line('tax'); ?><span class="text-danger">*</span></label>
                                <span id="m_tax_id_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control " id="m_tax_id" name="m_tax_id"  style="width: 100%;">
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

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_purchase_price"><?= $this->lang->line('purchase_price'); ?><span class="text-danger">*</span></label>
                                <span id="m_purchase_price_msg" style="display:none" class="text-danger"></span>
                                <input type="text" readonly="" class="form-control only_currency" id="m_purchase_price" name="m_purchase_price">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_tax_type"><?= $this->lang->line('tax_type'); ?><span class="text-danger">*</span></label>
                                <span id="m_tax_type_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control " id="m_tax_type" name="m_tax_type"  style="width: 100%;">
                                   <option value="Inclusive">Inclusive</option>
                                    <option value="Exclusive">Exclusive</option>
                                 </select>
                              </div>
                            </div>
                          </div>


                          

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_profit_margin"><?= $this->lang->line('profit_margin'); ?>(%)<i class="hover-q " data-container="body" data-toggle="popover" data-placement="top" data-content="<?= $this->lang->line('based_on_purchase_price'); ?>" data-html="true" data-trigger="hover" data-original-title="">
                                  <i class="fa fa-info-circle text-maroon text-black hover-q"></i>
                                </i></label>
                                <span id="m_profit_margin_msg" class="text-danger text-right pull-right"></span>
                                <input type="email" class="form-control no_special_char_no_space" id="m_profit_margin" name="m_profit_margin" placeholder=""  >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_sales_price"><?= $this->lang->line('sales_price'); ?><span class="text-danger">*</span></label>
                                <span id="m_sales_price_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" maxlength="10" class="form-control maxlength no_special_char_no_space " id="m_sales_price" name="m_sales_price" placeholder=""  >
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_mrp"><?= $this->lang->line('mrp'); ?><i class="hover-q " data-container="body" data-toggle="popover" data-placement="top" data-content="<?= $this->lang->line('mrp_definition'); ?>" data-html="true" data-trigger="hover" data-original-title="">
                                  <i class="fa fa-info-circle text-maroon text-black hover-q"></i>
                                </i></label>
                                <span id="m_mrp_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" maxlength="10" class="form-control maxlength no_special_char_no_space " id="m_mrp" name="m_mrp" placeholder="Maximum Retail Price"  >
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

                        <hr>
                        <div class="row">                          
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="m_warehouse_id"><?= $this->lang->line('warehouse'); ?></label>
                                <span id="warehouse_id_msg" class="text-danger text-right pull-right"></span>
                                <select class="form-control " id="m_warehouse_id" name="m_warehouse_id"  style="width: 100%;">
                                   <?= get_warehouse_select_list();?>
                                 </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="adjustment_qty"><?= $this->lang->line('opening_stock'); ?></label>
                                <span id="adjustment_qty_msg" class="text-danger text-right pull-right"></span>
                                <input type="text" class="form-control maxlength no_special_char_no_space " id="adjustment_qty" name="adjustment_qty" placeholder="" value='0'  >
                              </div>
                            </div>
                          </div>
                        </div>

                       
                    </div>
                    <div class="modal-footer">
                      
                      <input type="hidden" name="existing_row_count" value="0">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary add_item">Save</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
               <?= form_close();?>
              </div>
              <!-- /.modal -->