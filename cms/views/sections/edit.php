<?php
$page = 'Sections';
$sub_page = 'Update Section';
require ADMIN_VIEW . '/layout/header.php'; ?>
<!-- Content area -->
<div class="content">
    <?php
    require ADMIN_VIEW . '/layout/alert.php';
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Add Section</h5>
                </div>
				<script>
					function operate_slug(paras1, paras2){
						var en_title_val = document.getElementById(paras1).value;
						en_title_val = en_title_val.replace(/&/g, '');
						en_title_val = en_title_val.replace(/#/g, '');
						en_title_val = en_title_val.replace(/ /g, '-');
						en_title_val = en_title_val.replace(/"/g, '');
						en_title_val = en_title_val.replace(/'/g, '');
						document.getElementById(paras2).value = en_title_val.toLowerCase();
					}
				</script>  
				<style>
					a.fileinput-upload-button {
						display: none !important;
					}
					#fetch_section_tabs_container input[type="file"][data-fouc] {
						opacity: 1 !important;
					}
				</style>
                <div class="card-body">
                    <form name="datas_form" id="datas_form" method="post" action="<?php echo ADMIN_SITE_URL . '/controller/sections/edit.php?id='.$row['id']; ?>" enctype="multipart/form-data">
						<input type="hidden" id="section_id" name="section_id" value="<?php echo $row['id']; ?>" /> 
						<div class="row">
                            <div class="col-md-6">
                              <div class="form-group">   
								<label for="en_title"> Title (En):</label>
								<input type="text" name="en_title" id="en_title" value="<?php echo $row['en_title']; ?>" class="form-control" placeholder="Title in English" onkeyup="operate_slug('en_title', 'slug');" required />
								</div>   
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
									<label for="ar_title">Title (Ar):</label>
									<input type="text" name="ar_title" id="ar_title" value="<?php echo $row['ar_title']; ?>" class="form-control" placeholder="Title in Arabic" required />
								</div>  
                            </div>
                        </div>  
						<div class="row">
                            <div class="col-md-6">
                              <div class="form-group">   
								<label for="en_sub_title"> Sub Title (En):</label>
								<input type="text" name="en_sub_title" id="en_sub_title" value="<?php echo $row['en_sub_title']; ?>" class="form-control" placeholder="Sub Title in English" required />
								</div>   
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
									<label for="ar_sub_title">Sub Title (Ar):</label>
									<input type="text" name="ar_sub_title" id="ar_sub_title" value="<?php echo $row['ar_sub_title']; ?>" class="form-control" placeholder="Sub Title in Arabic" required />
								</div>  
                            </div>
                        </div> 
						<div class="row">
                            <div class="col-md-6"> 
								<div class="form-group">
									<label for="status"> Status: </label> 
									<select name="status" id="status" class="form-control ">
										<option value=""> Select Status </option>
										<option value="1" <?php echo ($row['status'] == 1) ? 'selected="selected"' : ''; ?>> Active </option>
										<option value="0" <?php echo ($row['status'] == 0) ? 'selected="selected"' : ''; ?>> Inactive </option> 
									</select>
								</div> 
							</div> 
							
							<div class="col-md-6">
                                <div class="form-group">
									<label for="sort_order"> Sort Order: </label>
									<input type="text" name="sort_order" id="sort_order" value="<?php echo $row['sort_order']; ?>" class="form-control" placeholder="Sort Order" required />
								</div> 
                            </div> 
						</div>
						
						<div class="row">
                            <div class="col-md-6">
                                 <div class="form-group">
									<label for="slug"> Slug: </label>
									<input type="text" name="slug" id="slug" value="<?php echo $row['slug']; ?>" class="form-control" placeholder="Slug" required />
								</div>
                            </div>
                            
							<div class="col-md-6"> 
								  <div class="form-group">
									<label for="bg_video">Bg Video:</label> <!-- class="file-input-overwrite" data-fouc  -->
									<input type="file" name="bg_video" id="bg_video" class="file-input-overwrite" data-fouc />
									<input type="hidden" name="old_bg_video" id="old_bg_video" value="<?php echo $row['bg_video']; ?>" />
									<?php echo ($row['bg_video'] != '') ? '( '.$row['bg_video']. ' )' : ''; ?> 
								</div>
							</div> 
                        </div>
						 
						<div class="row">
                            <div class="col-md-12"> <h3 style="text-decoration:underline">Section Tabs</h3> </div>
						</div>
						 
						
						 
				<div id="fetch_section_tabs_container">  
				<?php 
					$p=0;
					if($records){  
						foreach($records as $record){ 
							if($p >0){ 
								break;
							} ?>  
							<div id="fetch_section_tab_item<?php echo $p; ?>">
							
								<div class="row">
									<div class="col-md-12"> <hr /> </div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tab_en_title<?php echo $p; ?>"> Tab Title (En):</label>
											<input type="text" name="tab_en_title[]" id="tab_en_title<?php echo $p; ?>" class="form-control" placeholder="Tab Title in English" value="<?php echo $record['en_title']; ?>" onKeyUp="operate_slug('tab_en_title<?php echo $p; ?>', 'tab_slug<?php echo $p; ?>');" required />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="tab_ar_title<?php echo $p; ?>">Tab Title (Ar):</label>
											<input type="text" name="tab_ar_title[]" id="tab_ar_title<?php echo $p; ?>" class="form-control" placeholder="Tab Title in Arabic" value="<?php echo $record['ar_title']; ?>" required />
										</div>
									</div>
								</div>
							  
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
										<label for="tab_slug<?php echo $p; ?>"> Tab Slug: </label>
										<input type="text" name="tab_slug[]" id="tab_slug<?php echo $p; ?>" class="form-control" placeholder="Tab Slug" value="<?php echo $record['slug']; ?>" required />
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										<label for="tab_sort_order<?php echo $p; ?>"> Tab Sort Order: </label>
										<input type="text" name="tab_sort_order[]" id="tab_sort_order<?php echo $p; ?>" class="form-control" placeholder="Tab Sort Order" value="<?php echo $record['sort_order']; ?>" required />
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
										<label for="tab_status<?php echo $p; ?>"> Status: </label>
										<select name="tab_status[]" id="tab_status<?php echo $p; ?>" class="form-control">
										  <option value=""> Select Tab Status </option>
										  <option value="1" <?php echo ($record['status'] ==1) ? 'selected="selected"' : ''; ?>> Active </option>
										  <option value="0" <?php echo ($record['status'] ==0) ? 'selected="selected"' : ''; ?>> Inactive </option>
										</select>
									  </div>
									</div> 
								</div>
						  
							  <div class="row"> 
								<div class="col-md-6">
								  <div class="form-group">  <!-- class="file-input-overwrite" -->
									<label for="tab_icon<?php echo $p; ?>">Tab Icon:</label>
									<input type="file" name="tab_icon[]" id="tab_icon<?php echo $p; ?>" data-fouc />
									<input type="hidden" name="old_tab_icon[]" id="old_tab_icon<?php echo $p; ?>" value="<?php echo $record['tab_icon']; ?>" /> <?php echo ($record['tab_icon'] != '') ? '( '.$record['tab_icon']. ' )' : ''; ?> 
								  </div>
								 </div> 
								 <div class="col-md-6"> 
								  <div class="form-group"> <!-- class="file-input-overwrite" -->
									<label for="tab_bg_video<?php echo $p; ?>">Bg Video:</label>
									<input type="file" name="tab_bg_video[]" id="tab_bg_video<?php echo $p; ?>"  data-fouc />
									<input type="hidden" name="old_tab_bg_video[]" id="old_tab_bg_video<?php echo $p; ?>" value="<?php echo $record['bg_video']; ?>" /> <?php echo ($record['bg_video'] != '') ? '( '.$record['bg_video']. ' )' : ''; ?> 
								  </div>  
								 </div> 
							   </div>  
						 
						 	</div> 	
							<?php 
						$p++;
						} 
						
					}else{  ?> 
					<div id="fetch_section_tab_item0"> 
						 <div class="row">
							<div class="col-md-12"> <hr /> </div>
							<div class="col-md-6">
								<div class="form-group">
							<label for="tab_en_title0"> Tab Title (En):</label>
							<input type="text" name="tab_en_title[]" id="tab_en_title0" class="form-control" placeholder="Tab Title in English" onKeyUp="operate_slug('tab_en_title0', 'tab_slug0');" required />
						  </div> 
							</div>
							<div class="col-md-6">
								<div class="form-group">
							<label for="tab_ar_title0">Tab Title (Ar):</label>
							<input type="text" name="tab_ar_title[]" id="tab_ar_title0" class="form-control" placeholder="Tab Title in Arabic" required />
						  </div>
							</div>
						</div> 
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
							<label for="tab_slug0"> Tab Slug: </label>
							<input type="text" name="tab_slug[]" id="tab_slug0" class="form-control" placeholder="Tab Slug" required />
						  </div> 
							</div>
							<div class="col-md-4"> 
							  <div class="form-group">
								<label for="tab_sort_order0"> Tab Sort Order: </label>
								<input type="text" name="tab_sort_order[]" id="tab_sort_order0" class="form-control" placeholder="Tab Sort Order" value="0" required />
							  </div> 
							</div>
							<div class="col-md-4">
							  <div class="form-group">
								<label for="tab_status0"> Status: </label>
								<select name="tab_status[]" id="tab_status0" class="form-control">
								  <option value=""> Select Tab Status </option>
								  <option value="1"> Active </option>
								  <option value="0"> Inactive </option>
								</select>
							  </div>
							</div>
						</div> 
						<div class="row">
							<div class="col-md-6">
							  <div class="form-group"> <!-- class="file-input-overwrite" -->
								<label for="tab_icon0">Tab Icon:</label>
								<input type="file" name="tab_icon[]" id="tab_icon0" data-fouc />
							  </div> 
							</div>
							<div class="col-md-6">
								<div class="form-group"> <!-- class="file-input-overwrite"  -->
									<label for="tab_bg_video0">Bg Video:</label>
									<input type="file" name="tab_bg_video[]" id="tab_bg_video0" data-fouc />
								  </div> 
							</div>
						</div> 
				   </div>	 
				<?php } ?> 
							 
					<div id="fetch_section_tabs_list">
					<?php 
						$p=0;
						if($records){  
							foreach($records as $record){ 
								if($p >0){ ?>  
									<div id="fetch_section_tab_item<?php echo $p; ?>"> 
									
									<div class="row">
										<div class="col-md-12"> <hr /> </div>
										<div class="col-md-6">
											<div class="form-group">
										<label for="tab_en_title<?php echo $p; ?>"> Tab Title (En):</label>
										<input type="text" name="tab_en_title[]" id="tab_en_title<?php echo $p; ?>" class="form-control" placeholder="Tab Title in English" value="<?php echo $record['en_title']; ?>" onKeyUp="operate_slug('tab_en_title<?php echo $p; ?>', 'tab_slug<?php echo $p; ?>');" required />
									  </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
										<label for="tab_ar_title<?php echo $p; ?>">Tab Title (Ar):</label>
										<input type="text" name="tab_ar_title[]" id="tab_ar_title<?php echo $p; ?>" class="form-control" placeholder="Tab Title in Arabic" value="<?php echo $record['ar_title']; ?>" required />
									  </div> 
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="tab_slug<?php echo $p; ?>"> Tab Slug: </label>
												<input type="text" name="tab_slug[]" id="tab_slug<?php echo $p; ?>" class="form-control" placeholder="Tab Slug" value="<?php echo $record['slug']; ?>" required />
										  </div> 
										</div>
										<div class="col-md-4"> 
										  <div class="form-group">
											<label for="tab_sort_order<?php echo $p; ?>"> Tab Sort Order: </label>
											<input type="text" name="tab_sort_order[]" id="tab_sort_order<?php echo $p; ?>" class="form-control" placeholder="Tab Sort Order" value="<?php echo $record['sort_order']; ?>" required />
										  </div> 
										</div> 
										<div class="col-md-4"> 
										  <div class="form-group">
											<label for="tab_status<?php echo $p; ?>"> Status: </label>
											<select name="tab_status[]" id="tab_status<?php echo $p; ?>" class="form-control">
											  <option value=""> Select Tab Status </option>
											  <option value="1" <?php echo ($record['status'] ==1) ? 'selected="selected"' : ''; ?>> Active </option>
											  <option value="0" <?php echo ($record['status'] ==0) ? 'selected="selected"' : ''; ?>> Inactive </option>
											</select>
										  </div> 
										</div>
									</div> 
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group"> <!--  class="file-input-overwrite"  -->
										<label for="tab_icon<?php echo $p; ?>">Tab Icon:</label> 
										<input type="file" name="tab_icon[]" id="tab_icon<?php echo $p; ?>" data-fouc />
										<input type="hidden" name="old_tab_icon[]" id="old_tab_icon<?php echo $p; ?>" value="<?php echo $record['tab_icon']; ?>" /> <?php echo ($record['tab_icon'] != '') ? '( '.$record['tab_icon']. ' )' : ''; ?> 
									  </div> 
										</div>
										<div class="col-md-6">
											<div class="form-group">  <!-- class="file-input-overwrite" -->
										<label for="tab_bg_video<?php echo $p; ?>">Bg Video:</label>
										<input type="file" name="tab_bg_video[]" id="tab_bg_video<?php echo $p; ?>"  data-fouc />
										<input type="hidden" name="old_tab_bg_video[]" id="old_tab_bg_video<?php echo $p; ?>" value="<?php echo $record['bg_video']; ?>" /> <?php echo ($record['bg_video'] != '') ? '( '.$record['bg_video']. ' )' : ''; ?> 
									  </div>   
										</div>
									</div> 
									  
									  <span class="col-md-1" style="float:right;" align="right"> <a href="javascript:void(0);" onclick="remove_section_tab_item('<?php echo $p; ?>');" title="Remove" name="remove_section_tab_item_btn"><i class="icon-trash"> </i></a> </span>
									</div>  
								<?php
								}
							  $p++;
							}  
						} ?> 
					 </div>		 
					<div>
							 
					 <a class="btn bg-blue-300" href="javascript:void(0);" name="add_section_tabs_btns" id="add_section_tabs_btns">Add Section Tab</a>
					</div> 
				</div>  
						
				<div class="text-right">
					<input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>" />
					<button name="updates" type="submit" class="btn btn-primary"> Update <i class="icon-plus-circle2 ml-2"></i></button>
					<button name="cancels" type="button" class="btn btn-default" onclick="window.location='<?php echo ADMIN_SITE_URL . '/controller/sections/index.php'; ?>'"> Cancel </button>
				</div>	
			</form> 
			
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
<?php
require ADMIN_VIEW . '/layout/footer.php';
?>
  
<script>   
    $(document).ready(function() { 
	
        $('#navlink-sections').addClass('nav-item-open');
        $('#navlink-sections ul').css('display', 'block');
        $('#navlink-sections_add').addClass('active');
		
		
		var validator = $('#datas_form').validate({
			rules: {        
				en_title: {
					required: true, 
				},
				ar_title: {
					required: true, 
				},
				slug: {
					required: true, 
				},
				sort_order: {
					required: true, 
				},
				/*bg_video: {
					required: true, 
				},*/
			},
			messages: {
				en_title: {
					required: "This is required field", 
				},
				ar_title: {
					required: "This is required field", 
				},
				slug: {
					required: "This is required field", 
				},
				sort_order: {
					required: "This is required field", 
				},
				/*bg_video: {
					required: "This is required field", 
				},*/ 
			},
			errorPlacement: function(error, element) {
			  var placement = $(element).data('error');
			  if (placement) {
				$(placement).append(error)
			  } else {
				error.insertAfter(element);
			  }
			},  
			submitHandler: function(){ 
				document.forms["datas_form"].submit();
			}  
		});
		
		
		 
		var counter = 1; 
		$("#add_section_tabs_btns").click(function(){
			/*var newTextBoxDiv = $(document.createElement('div')).attr("id", 'fetch_section_tab_item'+counter,"class",'col-md-6 col-md-offset-2'); */
			var newTextBoxDiv = $(document.createElement('div')).attr("id", 'fetch_section_tab_item'+counter);  
				   
			var tab_section_item_data = document.getElementById('fetch_section_tab_item0').innerHTML; 		
			  
			//tab_en_title0 tab_ar_title0 tab_slug0  tab_sort_order0  tab_icon0 tab_status0
			
			tab_section_item_data = tab_section_item_data.replace(/tab_en_title0/g, "tab_en_title"+counter);
			tab_section_item_data = tab_section_item_data.replace(/tab_ar_title0/g, "tab_ar_title"+counter);
			tab_section_item_data = tab_section_item_data.replace(/tab_slug0/g, "tab_slug"+counter);
			tab_section_item_data = tab_section_item_data.replace(/tab_sort_order0/g, "tab_sort_order"+counter);
			tab_section_item_data = tab_section_item_data.replace(/tab_icon0/g, "tab_icon"+counter);
			tab_section_item_data = tab_section_item_data.replace(/tab_status0/g, "tab_status"+counter); 
											
			var del_item_data = '<span class="col-md-1" style="float:right;" align="right"> <a href="javascript:void(0);" onclick="remove_section_tab_item(\''+counter+'\');" title="Remove" name="remove_section_tab_item_btn"><i class="icon-trash"> </i></a> </span>';
			
			var new_tab_section_item_data = tab_section_item_data + del_item_data;  
			
			newTextBoxDiv.html(new_tab_section_item_data); 
			newTextBoxDiv.appendTo("#fetch_section_tabs_list"); 
			
			$("#tab_sort_order"+counter).val(counter); 
			counter = counter+1; 
			
		 });   

        /*$('.file-input-overwrite').on(
            "filebatchuploadcomplete",
            function(event, preview, config, tags, extraData) {
                console.log(config);
                const atts = [{
                    'key': 'type',
                    'value': 'hidden'
                }, {
                    'key': 'name',
                    'value': 'file_keys[]'
                }];
                config.forEach(function(file) {
                    var input = document.createElement('input');
                    atts.forEach(function(value, index) {
                        var att = document.createAttribute(value.key);
                        att.value = value.value;
                        input.setAttributeNode(att);
                    })
                    input.value = file.key;
                    $('#screen-form').append(input);
                })
            }
        );

        var validator = $("#data-form").validate({
            ignore: "input[type=hidden], .select2-search__field", // ignore hidden fields
            errorClass: "validation-invalid-label",
            successClass: "validation-valid-label",
            validClass: "validation-valid-label",
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            submitHandler: function() {
                document.forms["screen-form"].submit();
            },
            // Different components require proper error label placement
            errorPlacement: function(error, element) {
                // Unstyled checkboxes, radios
                if (element.parents().hasClass("form-check")) {
                    error.appendTo(element.parents(".form-check").parent());
                }

                // Input with icons and Select2
                else if (
                    element.parents().hasClass("form-group-feedback") ||
                    element.hasClass("select2-hidden-accessible")
                ) {
                    error.appendTo(element.parent());
                }

                // Input group, styled file input
                else if (
                    element.parent().is(".uniform-uploader, .uniform-select") ||
                    element.parents().hasClass("input-group")
                ) {
                    error.appendTo(element.parent().parent());
                }

                // Other elements
                else {
                    error.insertAfter(element);
                }
            },
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Enter screen name",
                },
            },
        }); */  

     });
	
	function remove_section_tab_item(val){
		var conf = confirm('Do you want to delete this?');
		if(conf){ 
			$("#fetch_section_tab_item"+val).remove(); 
		} 
	} 
</script>

</body>

</html>