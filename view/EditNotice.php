<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';
	
	//Edit Notice
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">Add Notice</h3></div>
                <form name=editnotice method=post action="?page=website&editnotice='.$noticeinfo[0].'">
                  <div class="box-body">
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select name="category" class="form-control select2" style="width: 100%;">
                              <option value="0"'; if($noticeinfo[4] == 0)echo 'selected="selected"'; echo'>Notice</option>
                              <option value="1"'; if($noticeinfo[4] == 1)echo 'selected="selected"'; echo'>Event</option>
							  <option value="2"'; if($noticeinfo[4] == 2)echo 'selected="selected"'; echo'>Patch Log</option>
							  <option value="3"'; if($noticeinfo[4] == 3)echo 'selected="selected"'; echo'>Maintenance</option>
                            </select>
                          </div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <input name="title" id="text" type="text" class="form-control" value="'.$noticeinfo[1].'">
						</div>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Message</label>
                      <div class="col-sm-10">
						<div style="margin-bottom:10px;" class="input-group col-sm-12">
						  <textarea name="message" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">'.$noticeinfo[2].'</textarea>
						</div>
                      </div>
                    </div>
                  </div>
				  <div class="box-footer"><button type="submit" class="btn btn-success pull-right">Save Notice</button></div>
                </form>
              </div>';
	
	//End
    echo'</div></section></div>';

?>