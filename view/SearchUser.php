<script>
function showResult(str) 
{
	if (str.length==0) {
		document.getElementById("results").innerHTML="";
		return;
	 }
	 
	 if(str.trim()=='')
	 {
		document.getElementById("results").innerHTML="";
		return; 
	 }
	 
	if (window.XMLHttpRequest) 
	{
		xmlhttp=new XMLHttpRequest();
	} 
	else 
	{ 
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function() 
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200) 
		{
		  document.getElementById("results").innerHTML=xmlhttp.responseText;
		}
	}
		
	xmlhttp.open("GET","?page=user&search="+str+"&by="+$( "#searchby option:selected" ).text(),true);
	xmlhttp.send();
}
</script>

<?php

	//Header
	echo '<div class="content-wrapper"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
	<section class="content"><div class="row"><div class="col-md-12">';

	//Box Search 
	echo '<div class="box box-info"><div class="box-header with-border"><h3 class="box-title">Search</h3></div>
                <form class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Search By</label>
                      <div class="col-sm-10">
                          <div style="margin-bottom:10px;">
                            <select onchange="showResult(this.value)" id="searchby" class="form-control select2" style="width: 100%;">
                              <option>ID</option>
                              <option selected="selected">Account Name</option>
                              <option>Character Name</option>
							  <option>Password</option>
                              <option>IP</option>
                              <option>Email</option>
                            </select>
                          </div>
                        <input type="text" class="form-control" onkeyup="showResult(this.value)">
                      </div>
                    </div>
                  </div>
                </form>
              </div>';
			  
	//Results
	echo '<div class="box box-danger"><div class="box-header with-border"><h3 class="box-title">Results</h3></div>
	<div id="results" style="margin-top:10px"> 
	</div>
    </div></div>';

	//End
    echo'</div></section></div>';

?>