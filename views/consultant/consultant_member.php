<script type="text/javascript">


$(document).ready(function(){
     
   $.ajax({
        url: site_url("ajax/department/"),
        success: function(result){
            
                var id="#deptartmets";
            
                $(id).append(result);
            }
        
    });
   $('#deptartmets').on('change' , function()
    {

        onclick_empname(this.value);
        
    
    }); 
   $('#select_name').on('change' , function()
    {

        document.getElementById('select_no').value=this.value;
        designation(this.value);

    
    }); 
   
    $('#add_member').click(function(){
        var sr_no='<?echo $sr_no;?>';
        var dept_id=$('#deptartmets').val();
        var emp_no=$('#select_no').val();
        var position=$('#position_select2').val();
        var share=$('#share2').val();
        var share1=$('#share1').val();
        var modv='0';
        dept_id=dept_id.trim();
        emp_no=emp_no.trim();
        
        if(share=='')
        {
           alert('enter the share value');
        }
        else
        {
            var shr=parseInt(share);
            if(shr>100)
            {
              alert('Share should be less than 100');
               e.preventDefault();
            }
            $.ajax({
                type : "POST",
                url : site_url("consultant/consultant_ajax/member1/"+share1),
                data : {
                    'sr_no' : sr_no,
                    'emp_no' : emp_no,
                    'department' : dept_id,
                    'position' : position,
                    'share' : share,
                    'modification_value' : modv,
                    
                   },
                 success : function(result){
                   $('#emp_row').html(result);
                },
                error : function(){
                    alert('some thing went wrong. please report');
           
              }
        
           });
        }
        
        
       
});
});
function onclick_empname(dept)
    {

        document.getElementById('employee').style.display="inherit";
        var emp_name=document.getElementById('select_name');

        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                emp_name.innerHTML += xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST",site_url("ajax/empNameByDept/"+dept),true);
        xmlhttp.send();
        emp_name.innerHTML = "<i class=\"loading\"></i>";
    }
function designation(emp_no)
{
    var des_name=document.getElementById('des_sel');
    var xmlhttp;
    if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
    else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                
                des_name.value = xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST",site_url("consultant/consultant/designation/"+emp_no),true);
        xmlhttp.send();
        des_name.innerHTML = "<i class=\"loading\"></i>";
}
function clickEvent(emp_no)
{
  var sr_no='<?echo $sr_no;?>';
   $.ajax({
        type : "POST",
        url : site_url("consultant/consultant_ajax/rm_member/"),
        data : {
            'sr_no' : sr_no,
            'emp_no' : emp_no,
           
           },
         success : function(result){
           $('#emp_row').html(result);
        },
        error : function(){
            alert('some thing went wrong. please report');
   
      }
        
});

}
function OnEvent(emp_no)
{
  var sr_no='<?echo $sr_no;?>';
  var share1=$('#share1').val();
   var shr=parseInt(share1);
            if(shr>100)
            {
              alert('Share should be less than 100');
               e.preventDefault();
            }
   $.ajax({
        type : "POST",
        url : site_url("consultant/consultant_ajax/edit_member/"+share1),
        data : {
            'sr_no' : sr_no,
            'emp_no' : emp_no,
           
           },
         success : function(result){
           $('#emp_row').html(result);
        },
        error : function(){
            alert('some thing went wrong. please report');
   
      }
        
});

}
</script>

<?php

/**
 * Author: Vivek Kumar
* Email: vivek0739@users.noreply.github.com
* Date: 19 june 2015
*/

    $ui = new UI();
    $errors=validation_errors();
    if($errors!='')
        $this->notification->drawNotification('Validation Errors',validation_errors(),'error');
    

$col1=$ui->col()->width(12)->open();
            /*$ui->input()
                 ->label('No. of person<span style= "color:red;"> *</span>')
                   ->type('text')
                   ->name('no_of_persons')
                   ->id("no_of_persons")

                   ->show();*/
                $table=$ui->table()
                  ->hover()
                  ->bordered()
                  ->width(12)
                  ->open()
                ?><thead>
                  <th>Department</th>
                  <th>Employee's Name</th>
                  <th>Employee No.</th>
                  <th>Designation</th>
                  <th>Position</th>
                  <th>Tentative Share</th>
                  <th></th>

                </thead>
               
                <?
                foreach ($members as $key => $member)
                 {
                  ?><tr>
                  <td>

                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                        ->type('text')
                       ->name('emp_dept')
                      ->id('emp_dept')
                      ->value($member->dept)
                      ->disabled()
                      ->show();
                       $innercol1->close();
                  ?></td>
                  <td>
                    <? $r3col1 = $ui->col()->id('employee')->open();
                  $ui->input()
                    ->type('text')
                    ->name('employee_select')
                    ->id('employee_select')
                    ->value($member->salutation." ".$member->first_name." ".$member->middle_name." ".$member->last_name)
                      ->disabled()
                    ->show();
                  $r3col1->close();
                  ?></td>
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('emp_no')
                     ->id('emp_no')
                    ->value($member->emp_no)
                    ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();
                  ?></td>
                  
                  <td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->id('des')
                      ->name('des')
                      ->value($member->designation)
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();
                  ?></td>
                  
                  <td>
                    <?
                    if($member->position=='ci')
                    {
                       $innercol1=$ui->col()->width(12)->open();
                      $ui->input()
                      ->type('text')
                     ->name('position_select')
                      ->id("position_select")
                      ->value('Consultancy-In-Charge')
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();
                    }
                    else if($member->position=='coci')
                    {
                       $innercol1=$ui->col()->width(12)->open();
                      $ui->input()
                      ->type('text')
                     ->name('position_select')
                      ->id("position_select")
                      ->value('CO-CI')
                      ->disabled()
                      ->width(12)
                      ->show();
                      $innercol1->close();
                    }
                    else 
                    {
                       $innercol1=$ui->col()->width(12)->open();
                      $ui->input()
                      ->type('text')
                     ->name('position_select')
                      ->id("position_select")
                      ->value('Faculty Member')
                      ->disabled()
                      ->width(12)
                      ->show();
                     $innercol1->close();
                    }
                    
                       
                  ?></td>
                  
                  
                  
        <?php 
              if($member->position !='ci')
              {
                ?><td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('share')
                      ->id("share")
                      ->value($member->share)
                      ->disabled()
                      ->width(12)
                      ->show();
                       $innercol1->close();
                  ?></td><?
                 echo '<td>';
                    $btn_string = 'onclick=' . '"clickEvent(\'' . $member->emp_no . '\')"'  ;
                    $ui->button()->icon($ui->icon("remove"))->id('remove')->extras($btn_string)->width(4)->uiType('danger')->name('remove')->value('Remove')->show();
                  
                echo '</td>';
              }
              else
              {
                ?><td>
                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->input()
                      ->type('text')
                      ->name('share1')
                      ->id("share1")
                      ->value($member->share)
                      
                      ->width(12)
                      ->show();
                       $innercol1->close();
                  ?></td><?
               echo '<td>';
                    $btn_string = 'onclick=' . '"OnEvent(\'' . $member->emp_no . '\')"'  ;
                    $ui->button()->icon($ui->icon("edit"))->id('edit')->extras($btn_string)->width(4)->uiType('primary')->name('edit')->value('Edit')->show();
                  
                echo '</td>';
              }
                ?>
                  </tr><?
                  
                }
          
                ?><tr>
                  <td>

                    <? $innercol1=$ui->col()->width(12)->open();
                    $ui->select()
                    ->name('deptartmets')
                    ->id('deptartmets')
                    ->options(array($ui->option()->value('0')->text('Select Employee Department')->disabled()->selected()))
                            ->show();
                       $innercol1->close();
                    ?></td>
                     <td>
                        <? $r3col1 = $ui->col()->id('employee')->open();
                  $ui->select()
                    ->name('select_name')
                    ->id('select_name')
                    ->options(array($ui->option()->value('0')->text('Select Employee')->disabled()->selected()))
                    ->show();
                  $r3col1->close();
                  ?></td>
                            <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                    ->type('text')
                                    ->name('select_no')
                                    ->id('select_no')
                                    ->value('')
                                    ->width(12)
                                    ->show();
                                   $innercol1->close();
                            ?></td>
                            
                            <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                    ->type('text')
                                    ->id('des_sel')
                                    ->name('des_sel')
                                    ->width(12)
                                    ->show();
                                   $innercol1->close();
                            ?></td>
                            
                            <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->select()
                                    ->name('position_select2')
                                    ->id("position_select2")
                                    ->options(array(
                                                $ui->option()->value('coci')->text('Co-consultant-in-charge'),
                                                $ui->option()->value('ftm')->text('Faculty Member')->selected()))
                            
                                    ->required()
                                    ->show();
                                   $innercol1->close();
                            ?></td>
                            
                            <td>
                                <? $innercol1=$ui->col()->width(12)->open();
                                $ui->input()
                                    ->type('text')
                      ->name('share2')
                      ->id("share2")
                                    ->width(12)
                                    ->show();
                                   $innercol1->close();
                            ?></td>
                        <td>
                 <? $col1=$ui->col()->width(2)->open();
                  
                   $ui->button()->icon($ui->icon('plus'))
                    ->mini()
                     ->id('add_member')
                      ->value('Add')
                      ->uiType('success')
                      ->show();
                  
                 $col1->close();
                 ?></td>
                            </tr><?
                    $table->close();
        $col1->close();