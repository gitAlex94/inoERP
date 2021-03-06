<div id="form_header"><span class="heading">Chart Of Account Code Combinations </span> 
 <div id="form_serach_header">
  <label>Chart Of Account :</label>
  <?php echo form::select_field_from_object('coa_id', coa::find_all(), 'coa_id', 'coa_name', $coa_id_h, 'coa_id', '', 1, $readonly); ?>
  <a name="show" href="form.php?class_name=coa_combination&<?php echo "mode=$mode"; ?>" class="show document_id coa_id"><img src="<?php echo HOME_URL; ?>themes/images/refresh.png"/></a> 
 </div>
</div>
<div id ="form_line" class="coa_combination"><span class="heading">Value Group Details </span>
 <div id="tabsLine">
  <ul class="tabMain">
   <li><a href="#tabsLine-1">Basics - View Only </a></li>
   <li><a href="#tabsLine-2">Field Values </a></li>
   <li><a href="#tabsLine-3">Effectivity </a></li>
  </ul>
  <div class="tabContainer"> 
   <form action=""  method="post" id="coa_combination_line"  name="coa_combination_line">
    <div id="tabsLine-1" class="tabContent">
     <table class="form_table">
      <thead> 
       <tr>
        <th>Action</th>
        <th>CC Id</th>
        <th>Code Combination</th>
        <th>Description</th>
        <th>Account Type</th>
       </tr>
      </thead>
      <tbody class="form_data_line_tbody coa_combination_values" >
       <?php
       $count = 0;
       $coa_combination_object_ai = new ArrayIterator($coa_combination_object);
       $coa_combination_object_ai->seek($position);
       while ($coa_combination_object_ai->valid()) {
        $coa_combination = $coa_combination_object_ai->current();
        ?>         
        <tr class="coa_combination<?php echo $count ?>">
         <td>    
          <ul class="inline_action">
           <li class="add_row_img"><img  src="<?php echo HOME_URL; ?>themes/images/add.png"  alt="add new line" /></li>
           <li class="remove_row_img"><img src="<?php echo HOME_URL; ?>themes/images/remove.png" alt="remove this line" /> </li>
           <li><input type="checkbox" name="line_id_cb" value="<?php echo htmlentities($coa_combination->coa_combination_id); ?>"></li>           
           <li><?php echo form::hidden_field('coa_id', $coa_id_h); ?></li>
          </ul>
         </td>
         <td><?php form::number_field_widsr('coa_combination_id'); ?></td>
         <td><?php echo form::text_field('combination', $$class->combination, 30, '', 1, '', 'Non editable - Enter segment/field values', 1); ?></td>
         <td><?php echo form::text_field('description', $$class->description, 60, '', 1, '', 'Non editable - Enter segment/field values', 1) ?></td>
         <td><?php echo $f->select_field_from_object('ac_type', coa::coa_account_types(), 'option_line_code', 'option_line_value', $$class->ac_type, '', '', 1, $readonly1); ?></td>
        </tr>
        <?php
        $coa_combination_object_ai->next();
        if ($coa_combination_object_ai->key() == $position + $per_page) {
         break;
        }
        $count = $count + 1;
       }
       ?>
      </tbody>
     </table>
    </div>
    <div id="tabsLine-2" class="tabContent">
     <table class="form_table">
      <thead> 
       <tr><?php
        if (!empty($coa_id_h)) {
         foreach (coa::coa_display_by_coaId($coa_id_h) as $key => $value) {
          echo!empty($value) ? "<th>$value : </th>" : '';
         }
        }
        ?>
       </tr>
      </thead>
      <tbody class="form_data_line_tbody coa_combination_values" >
       <?php
       $count = 0;
       $f = new inoform();
//       $coa_combination_object_ai = new ArrayIterator($coa_combination_object);S
       $coa_combination_object_ai->seek($position);
       while ($coa_combination_object_ai->valid()) {
        $coa_combination = $coa_combination_object_ai->current();
        $$class_second->findBy_id($coa_combination->coa_id);
        echo '<tr class="coa_combination' . $count . '">';
        if (!empty($$class_second->coa_id)) {
         $datacount = 1;
         foreach (coa::coa_display_by_coaId($$class_second->coa_id) as $key => $value) {
          if (!empty($value)) {
           $option_line = option_line::find_by_optionId_lineCode($$class_second->coa_structure_id, $value);
           $field_name = 'field' . $datacount;
           $descArray = ['code', 'description'];
           echo '<td>' .
           $f->select_field_from_object($field_name, sys_value_group_line::find_by_header_id($option_line->value_group_id), 'code', $descArray, $$class->$field_name, '',  'ac field_values', 1,$readonly ,'','','','account_qualifier')
           . '</td>';
           $datacount++;
          }
         }
        }
        echo '</tr>';
        $coa_combination_object_ai->next();
        if ($coa_combination_object_ai->key() == $position + $per_page) {
         break;
        }
        $count = $count + 1;
       }
       ?>
      </tbody>
     </table>
    </div>
    <div id="tabsLine-3" class="tabContent">
     <table class="form_table">
      <thead> 
       <tr>
        <th>Status</th>
        <th>Start Date</th>
        <th>End Date</th>
       </tr>
      </thead>
      <tbody class="form_data_line_tbody coa_combination_values" >
       <?php
       $count = 0;
//       $coa_combination_object_ai = new ArrayIterator($coa_combination_object);
       $coa_combination_object_ai->seek($position);
       while ($coa_combination_object_ai->valid()) {
        $coa_combination = $coa_combination_object_ai->current();
        ?>         
        <tr class="coa_combination<?php echo $count ?>">
         <td><?php echo form::status_field_d('status'); ?></td>
         <td><?php echo form::date_fieldAnyDay('effective_start_date', $$class->effective_start_date, '10', '', '', ''); ?></td>
         <td><?php echo form::date_fieldAnyDay('effective_end_date', $$class->effective_end_date, '10', '', '', ''); ?></td>
        </tr>
        <?php
        $coa_combination_object_ai->next();
        if ($coa_combination_object_ai->key() == $position + $per_page) {
         break;
        }
        $count = $count + 1;
       }
       ?>
      </tbody>
     </table>
    </div>
   </form>
  </div>

 </div>
</div> 

<div id="pagination" style="clear: both;">
 <?php echo $pagination->show_pagination(); ?>
</div>

<div id="js_data">
 <ul id="js_saving_data">
  <li class="lineClassName" data-lineClassName="coa_combination" ></li>
  <li class="line_key_field" data-line_key_field="combination" ></li>
  <li class="single_line" data-single_line="false" ></li>
  <li class="form_line_id" data-form_line_id="coa_combination" ></li>
 </ul>
 <ul id="js_contextMenu_data">
  <li class="docLineId" data-docLineId="coa_combination_id" ></li>
  <li class="btn2DivId" data-btn2DivId="form_line" ></li>
  <li class="trClass" data-trclass="coa_combination_line" ></li>
  <li class="tbodyClass" data-tbodyClass="form_data_line_tbody" ></li>
  <li class="noOfTabbs" data-noOfTabbs="3" ></li>
 </ul>
</div>