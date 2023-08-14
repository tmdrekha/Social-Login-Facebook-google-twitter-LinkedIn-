<?php echo $header; ?>
<div id="content">
	<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
	</div>
	<?php if ($error_warning) { ?>
	<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>
    <div class="box">
		<div class="heading">
		  <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title1; ?></h1>
		  <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
		</div>
        <div class="content">
	        <div id="tabs" class="htabs">
			     <a href="#tab-setting"><?php echo $tab_setting; ?></a>
                 <a href="#tab-facbook"><?php echo $tab_facbook; ?></a>
				 <a href="#tab-twitter"><?php echo $tab_twitter; ?></a>
                 <a href="#tab-google"><?php echo $tab_google; ?></a>
				 <a href="#tab-linkedin"><?php echo $tab_linkedin; ?></a>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            <div id="tab-setting">
		      <table class="form">			   
			    <tr>
					<td><?php echo $entry_iconsize; ?></td>
					<td>
					<input type="text" name="tmdsociallogin_width" value="<?php echo $tmdsociallogin_width; ?>" /> x
					<input type="text" name="tmdsociallogin_height" value="<?php echo $tmdsociallogin_height; ?>" />
					</td>
				</tr>
			    
				</table>
			</div>
		<div id="tab-facbook">
			<table class="form">
			    <tr>
				<td><?php echo $entry_title; ?></td>
				<td>
				  <input type="text" name="tmdsociallogin_fbtitle" value="<?php echo $tmdsociallogin_fbtitle; ?>" />
				 </td>
			    </tr>
			<tr>
			<td><?php echo $entry_image; ?></td>
            
            <td valign="top"><div class="image"><img src="<?php echo $tmdsociallogin_fbthumb; ?>" alt="" id="thumb" />
                  <input type="hidden" name="tmdsociallogin_fbimage" value="<?php echo $tmdsociallogin_fbimage; ?>" id="image" />
                  <br />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div>
            </td>
			
            </tr>
			<tr>
		        <td><?php echo $entry_apikey; ?></td>
				<td>
				   <input type="text" name="tmdsociallogin_fbapikey" value="<?php echo $tmdsociallogin_fbapikey; ?>" /> 
		   
				   <?php if ($error_fbapikey) { ?>
				  <div class="error"><?php echo $error_fbapikey; ?></div>
				  <?php } ?>
				  <?php echo $text_fblink; ?>
				  </td>
		    </tr>
				
		         
			<tr>
			    <td><?php echo $entry_apisecret; ?></td>  
				<td>
				 <input type="text" name="tmdsociallogin_fbsecretapi" value="<?php echo $tmdsociallogin_fbsecretapi; ?>" /> 
				 <?php if ($error_fbsecretapi) { ?>
				  <div class="error"><?php echo $error_fbsecretapi; ?></div>
				  <?php } ?>
				</td>
			</tr> 
			<tr>
				<td><?php echo $entry_status; ?></td>
				<td><select name="tmdsociallogin_fbstatus">
					<?php if ($tmdsociallogin_fbstatus) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</td>
			</tr>
			</table>
		</div>
			<div id="tab-twitter">
				<table class="form">
				    <tr>
					   <td><?php echo $entry_title; ?></td>
					   <td>
					     <input type="text" name="tmdsociallogin_twittertitle" value="<?php echo $tmdsociallogin_twittertitle; ?>" />
					    </td>
					</tr>
				    <tr> 
						<td><?php echo $entry_image; ?></td>
						<td valign="top"><div class="image"><img src="<?php echo $tmdsociallogin_twiterthumb; ?>" alt="" id="thumb-twitimage" />
							  <input type="hidden" name="tmdsociallogin_twitimage" value="<?php echo $tmdsociallogin_twitimage; ?>" id="image-twitimage" />
							  <br />
							  <a onclick="image_upload('image-twitimage', 'thumb-twitimage');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb-twitimage').attr('src', '<?php echo $no_image; ?>'); $('#image-twitimage').attr('value', '');"><?php echo $text_clear; ?></a></div>
						</td>
						 
                    </tr>
				    <tr>
		              <td><?php echo $entry_twapikey; ?></td> 
                      <td>
					  <input type="text" name="tmdsociallogin_twitapikey" value="<?php echo $tmdsociallogin_twitapikey; ?>" />
		              <?php if ($error_twitapikey) { ?>
				      <div class="error"><?php echo $error_twitapikey; ?></div>
				      <?php } ?>
				      <?php echo $text_twitlink; ?>
		              </td> 
				    </tr>
				     
		            <tr>
					   <td><?php echo $entry_twapisecret; ?></td> 
					   <td>
					   <input type="text" name="tmdsociallogin_twitsecretapi" value="<?php echo $tmdsociallogin_twitsecretapi; ?>" /> 
					   <?php if ($error_twitsecret) { ?>
				       <div class="error"><?php echo $error_twitsecret; ?></div>
				       <?php } ?>
					   </td> 
				    </tr>
			        <tr>
					   <td><?php echo $entry_status; ?></td>
					   <td><select name="tmdsociallogin_twitstatus" id="input-twitstatus"   class="form-control">
						 <?php if ($tmdsociallogin_twitstatus) { ?>
						 <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						 <option value="0"><?php echo $text_disabled; ?></option>
						 <?php } else { ?>
						 <option value="1"><?php echo $text_enabled; ?></option>
						 <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						 <?php } ?>
					     </select></td>
					</tr>
			    </table>
			</div>
			
			<div  id="tab-google">
				<table class="form">
				    <tr>  
					  <td><?php echo $entry_title; ?></td>
					  <td>
					  <input type="text" name="tmdsociallogin_googletitle" value="<?php echo $tmdsociallogin_googletitle; ?>" /></td>
					</tr>
				    <tr>
                      <td><?php echo $entry_image; ?></td>
						<td valign="top"><div class="image"><img src="<?php echo $tmdsociallogin_goglethumb; ?>" alt="" id="thumb-gogleimage" />
							  <input type="hidden" name="tmdsociallogin_gogleimage" value="<?php echo $tmdsociallogin_gogleimage; ?>" id="image-gogleimage" />
							  <br />
							  <a onclick="image_upload('image-gogleimage', 'thumb-gogleimage');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb-gogleimage').attr('src', '<?php echo $no_image; ?>'); $('#image-gogleimage').attr('value', '');"><?php echo $text_clear; ?></a></div>
						</td>
                    </tr>
				    <tr>
		               <td><?php echo $entry_goapikey; ?></td> 
					   <td>
					    <input type="text" name="tmdsociallogin_gogleapikey" value="<?php echo $tmdsociallogin_gogleapikey; ?>" />
				       <?php if ($error_gogleapikey) { ?>
				       <div class="error"><?php echo $error_gogleapikey; ?></div>
				       <?php } ?>
				       <?php echo $text_gogllink; ?>
				       </td>
		            </tr>
				    
				    <tr>
					   <td><?php echo $entry_goapisecret; ?></td>  
					   <td>
					     <input type="text" name="tmdsociallogin_gogelsecretapi" value="<?php echo $tmdsociallogin_gogelsecretapi; ?>" />
					     <?php if ($error_goglesecret) { ?>
				         <div class="error"><?php echo $error_goglesecret; ?></div>
				         <?php } ?>
				  	     </td>
					</tr>
				    <tr>
					   <td><?php echo $entry_status; ?></td>
					   <td><select name="tmdsociallogin_goglestatus" id="input-goglestatus" >
						<?php if ($tmdsociallogin_goglestatus) { ?>
						<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						<?php } ?>
					    </select></td>
					</tr>
				</table>
			</div>
			<div id="tab-linkedin">
				<table class="form">
				    <tr>
					  <td><?php echo $entry_title; ?></td>
					  <td>
					  <input type="text" name="tmdsociallogin_linkedintitle" value="<?php echo $tmdsociallogin_linkedintitle; ?>" />
					  </td>
				    </tr>
				    <tr>
                       <td><?php echo $entry_image; ?></td>
                       <td valign="top"><div class="image"><img src="<?php echo $tmdsociallogin_linkdinthumb; ?>" alt="" id="thumb-linkdinimage" />
							  <input type="hidden" name="tmdsociallogin_linkdinimage" value="<?php echo $tmdsociallogin_linkdinimage; ?>" id="image-linkdinimage" />
							  <br />
							  <a onclick="image_upload('image-linkdinimage', 'thumb-linkdinimage');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb-linkdinimage').attr('src', '<?php echo $no_image; ?>'); $('#image-linkdinimage').attr('value', '');"><?php echo $text_clear; ?></a></div>
						</td>
                       
                    
                    </tr>
				    <tr>
		               <td><?php echo $entry_liapikey; ?></td>  
				       <td>
					   <input type="text" name="tmdsociallogin_linkdinapikey" value="<?php echo $tmdsociallogin_linkdinapikey; ?>" /> 
		               <?php if ($error_linkdinapikey) { ?>
				       <div class="error"><?php echo $error_linkdinapikey; ?></div>
				       <?php } ?>
				       
				       <?php echo $text_linkdinlink; ?>
				  	  </td>
		            </tr>
				    
			        <tr>
			          <td><?php echo $entry_liapisecret; ?></td>  
				      <td>
				       <input type="text" name="tmdsociallogin_linkdinsecretapi" value="<?php echo $tmdsociallogin_linkdinsecretapi; ?>" />
				
				       <?php if ($error_linkdinsecret) { ?>
				       <div class="error"><?php echo $error_linkdinsecret; ?></div>
				       <?php } ?>
                       </td>					   
				    </tr>
			        <tr>
					   <td><?php echo $entry_status; ?></td>
					   <td><select name="tmdsociallogin_linkstatus" id="input-linkstatus" class="form-control">
						<?php if ($tmdsociallogin_linkstatus) { ?>
						<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
						<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						<?php } ?>
					  </select>
					  </td>
					</tr>
				</table>
			</div>
			
			
		 <table id="module" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_layout; ?></td>
              <td class="left"><?php echo $entry_position; ?></td>
              <td class="left"><?php echo $entry_status; ?></td>
              <td class="right"><?php echo $entry_sort_order; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php $module_row = 0; ?>
          <?php foreach ($modules as $module) { ?>
          <tbody id="module-row<?php echo $module_row; ?>">
            <tr>
              <td class="left"><select name="tmdsociallogin_module[<?php echo $module_row; ?>][layout_id]">
                  <?php foreach ($layouts as $layout) { ?>
                  <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                  <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td class="left"><select name="tmdsociallogin_module[<?php echo $module_row; ?>][position]">
                  <?php if ($module['position'] == 'content_top') { ?>
                  <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                  <?php } else { ?>
                  <option value="content_top"><?php echo $text_content_top; ?></option>
                  <?php } ?>
				  
				  <?php if ($module['position'] == 'column_login') { ?>
                  <option value="column_login" selected="selected"><?php echo $text_column_login; ?></option>
                  <?php } else { ?>
                  <option value="column_login"><?php echo $text_column_login; ?></option>
                  <?php } ?>
				  
				  
                  <?php if ($module['position'] == 'content_bottom') { ?>
                  <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                  <?php } else { ?>
                  <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                  <?php } ?>
                  <?php if ($module['position'] == 'column_left') { ?>
                  <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                  <?php } else { ?>
                  <option value="column_left"><?php echo $text_column_left; ?></option>
                  <?php } ?>
                  <?php if ($module['position'] == 'column_right') { ?>
                  <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                  <?php } else { ?>
                  <option value="column_right"><?php echo $text_column_right; ?></option>
                  <?php } ?>
                </select></td>
              <td class="left"><select name="tmdsociallogin_module[<?php echo $module_row; ?>][status]">
                  <?php if ($module['status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td class="right"><input type="text" name="tmdsociallogin_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
              <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $module_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="4"></td>
              <td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
            </tr>
          </tfoot>
        </table>
		
		
		
		</form>
		</div>
		</div> 
    </div>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script> 


<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	
	html += '    <td class="left"><select name="tmdsociallogin_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="tmdsociallogin_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="column_login"><?php echo $text_column_login; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="tmdsociallogin_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="tmdsociallogin_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script> 
<?php echo $footer; ?>
