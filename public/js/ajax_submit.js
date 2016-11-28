//Do not change 
function createObject() {
	var request_type;
	var browser = navigator.appName;
	if( browser == "Microsoft Internet Explorer"){
		request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		request_type = new XMLHttpRequest();
	}
	return request_type;
}

var http = createObject();

//---------------------------Standard CM Entry Start-----------------------------------------------------------------------
function fnc_standard_cm_entry(save_perm,edit_perm,delete_perm,approve_perm){
	var txt_mst_id	= escape(document.getElementById('txt_mst_id').value);
	var cbo_company_name	= escape(document.getElementById('cbo_company_name').value);
	var txt_applying_period_date	= escape(document.getElementById('txt_applying_period_date').value);
	var txt_applying_period_to_date	= escape(document.getElementById('txt_applying_period_to_date').value);
	var txt_bep_cm	= escape(document.getElementById('txt_bep_cm').value);
	var txt_asking_profit	= escape(document.getElementById('txt_asking_profit').value);
	var txt_asking_cm	= escape(document.getElementById('txt_asking_cm').value);
	var cbo_status	= escape(document.getElementById('cbo_status').value);
	var cbo_is_deleted	= escape(document.getElementById('cbo_is_deleted').value);
	var save_up = escape(document.getElementById('save_up').value);
	
	$('#messagebox').removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
	
	if (save_up==0 && save_perm==2)
	{		
		$("#messagebox").removeClass().addClass('messageboxerror').text('You do not have save permission.').fadeIn(1000);
	}
	else if (save_up!=0 && edit_perm==2) // no edit 
	{		
		$("#messagebox").removeClass().addClass('messageboxerror').text('You do not have update permission.').fadeIn(1000);
	}
	else if ( cbo_status==0 && delete_perm==2)
	{		
		$("#messagebox").removeClass().addClass('messageboxerror').text('You do not have delete permission.').fadeIn(1000);		
	}
	else if($('#cbo_company_name').val()==0){						
		$("#messagebox").fadeTo(200,0.1,function(){  //start fading the messagebox
			$('#cbo_company_name').focus();
			$(this).html('Please Select Company Name').addClass('messageboxerror').fadeTo(900,1);
		});		
	}	else{						
		nocache = Math.random();
		http.open('get','save_update_common.php?action=standard_cm_entry&isupdate='+save_up+
					'&cbo_company_name='+cbo_company_name+
					'&txt_applying_period_date='+txt_applying_period_date+
					'&txt_applying_period_to_date='+txt_applying_period_to_date+
					'&txt_bep_cm='+txt_bep_cm+
					'&txt_asking_profit='+txt_asking_profit+
					'&txt_asking_cm='+txt_asking_cm+
					'&cbo_status='+cbo_status+
					'&cbo_is_deleted='+cbo_is_deleted+
					'&nocache ='+nocache);
		http.onreadystatechange = standard_cm_entry_reply;
		http.send(null); 
	}
}

function standard_cm_entry_reply() {
	if(http.readyState == 4){ 		
		var response = http.responseText;		
		//alert(response);	
		if (response[0]==1)
		{
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				$(this).html('Duplicate Company Name, Please Check agian.').addClass('messageboxerror').fadeTo(900,1);				
			});
		}
		if (response[0]==3)
		{
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				$(this).html('Data Updated Successfully.').addClass('messagebox_ok').fadeTo(900,1);
				save_activities_history(response[2],"library","standard_cm_entry","update","../../");
				document.getElementById('txt_mst_id').value=response[1];
				showResult(' ','6','standard_cm_entry_list_view');				
				document.getElementById('save_up').value="";
			});
		}
		else if (response[0]==2)
		{
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				$(this).html('Inserted Successfully.').addClass('messagebox_ok').fadeTo(900,1);
				save_activities_history(response[2],"library","standard_cm_entry","insert","../../");
				document.getElementById('txt_mst_id').value=response[1];
				showResult(' ','6','standard_cm_entry_list_view');
				document.getElementById('save_up').value="";
			});
		}
	
	}
}	


//---------------------------Standard CM Entry End--------------------------------------------------------
function fnc_login_info(){
	var user_name     = escape(document.getElementById('user_name').value);		
	var user_password = escape(document.getElementById('user_password').value);	
		var remember = escape(document.getElementById('remember').value);	
	
					
					
	$("#messagebox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
	
	 if( $('#user_name').val() == "" ) {						
		$("#messagebox").fadeTo(200,0.1,function() {  //start fading the messagebox
			$('#user_name').focus();
			$(this).html('Please Enter User Name').addClass('messageboxerror').fadeTo(900,1);
		});		
	}
	else if( $('#user_password').val() == 0 ) {						
		$("#messagebox").fadeTo(200,0.1,function() {  //start fading the messagebox
			$('#apparel_type').focus();
			$(this).html('Please Enter Password').addClass('messageboxerror').fadeTo(900,1);
		});		
	}
	
	else{					
		nocache = Math.random();
		http.open('get','save_update_common.php?action=login_details&user_name='+user_name+
					'&user_password='+user_password+'&remember='+remember	);
		http.onreadystatechange = loginReply_info;
		http.send(null); 
	}
}

function loginReply_info() {
	if(http.readyState == 4){ 		
		//var response = http.responseText;	
		var response = http.responseText.split('_');	

		if (response[0]==1)
		{
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				   window.location.replace("home.php");
			});
		}
		else if (response[0]==2)
		{
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{				
				$(this).html('Your User Name or Password is not Accepted').addClass('messagebox_ok').fadeTo(200,1);
				
			
			});
		}
				
	
	
	}
}	

//---------------------------Login Info--------------------------------------------------------

function fnc_valitation_info(){
	
	
	
 if( $('#name').val() == "" ) {						
		$("#messagebox").fadeTo(200,0.1,function() {  //start fading the messagebox
			$('#first_name').focus();
			$(this).html('Please Enter First Name').addClass('messageboxerror').fadeTo(900,1);
		});		
	}	
	
	else if( $('#email').val() == "" ) {						
		$("#messagebox").fadeTo(200,0.1,function() {  //start fading the messagebox
			$('#email').focus();
			$(this).html('Please Enter Mail Address').addClass('messageboxerror').fadeTo(900,1);
		});		
	}	

	else if( $('#password').val() == "" ) {						
		$("#messagebox").fadeTo(200,0.1,function() {  //start fading the messagebox
			$('#password').focus();
			$(this).html('Please Enter Password').addClass('messageboxerror').fadeTo(900,1);
		});		
	}	

	else if( $('#confirm_password').val() == "" ) {						
		$("#messagebox").fadeTo(200,0.1,function() {  //start fading the messagebox
			$('#confirm_password').focus();
			$(this).html('Please Confirm Password').addClass('messageboxerror').fadeTo(900,1);
		});		
	}	

	

	else if($('#password').val() != $('#confirm_password').val()){
		 
		 
			 $("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				$(this).html("Password Don't Match, Please Check agian.").addClass('messageboxerror').fadeTo(900,1);	
				
							
			});

 			$('#confirm_password').focus();
 	
 }
 
 
 
 else {
	
	var name	= escape(document.getElementById('name').value);
	var student_check	= escape(document.getElementById('student_check').value);
	var country_teacher	= escape(document.getElementById('country_teacher').value);
	var country_guest	= escape(document.getElementById('country_guest').value);
	var student_check	= escape(document.getElementById('student_check').value);
	var faculty_check	= escape(document.getElementById('faculty_check').value);
	var guest_check	= escape(document.getElementById('guest_check').value);
	var email		= escape(document.getElementById('email').value);
	var password	= escape(document.getElementById('password').value);
	var confirm_password	= escape(document.getElementById('confirm_password').value);
	var type_guest				= escape(document.getElementById('type_guest').value);
	var description		= escape(document.getElementById('description').value);
	var country_guest				= escape(document.getElementById('country_guest').value);
	var email_guest				= escape(document.getElementById('email_guest').value);
	var job_title				= escape(document.getElementById('job_title').value);
	var fac_univesity				= escape(document.getElementById('fac_univesity').value);
	var country_teacher				= escape(document.getElementById('country_teacher').value);
	var fac_email				= escape(document.getElementById('fac_email').value);
	var end_year				= escape(document.getElementById('end_year').value);
	var start_year				= escape(document.getElementById('start_year').value);
	var degree				= escape(document.getElementById('degree').value);
	var univesity				= escape(document.getElementById('univesity').value);
	var country				= escape(document.getElementById('country').value);
	
	
	
	
	var save_up="";
						
		nocache = Math.random();
		http.open('get','save_update_common.php?action=registration&isupdate='+save_up+
					'&name='+name+
					'&student_check='+student_check+
					'&country_teacher='+country_teacher+
					'&country_guest='+country_guest+					
					'&faculty_check='+faculty_check+
					'&guest_check='+guest_check+
					'&email='+email+
					'&password='+password+
					'&type_guest='+type_guest+
					'&description='+description+
					'&country_guest='+country_guest+
					'&email_guest='+email_guest+
					'&job_title='+job_title+
					'&fac_univesity='+fac_univesity+
					'&country_teacher='+country_teacher+
					'&fac_email='+fac_email+
					'&end_year='+end_year+
					'&start_year='+start_year+
					'&degree='+degree+
					'&univesity='+univesity+					
					'&country='+country);
		http.onreadystatechange = standard_cm_entry_reply;
		http.send(null); 
 }
}

function standard_cm_entry_reply() {
	if(http.readyState == 4){ 		
		var response = http.responseText;
		
		
		if (response==0)
		{
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				$(this).html("Captcha Don't Match, Please Check agian.").addClass('messageboxerror').fadeTo(900,1);				
			});
			$('#messagebox').focus();
		}	
		//alert(response);	
		if (response==1)
		{
			alert('Duplicate Email Address, Please Check agian.');
			
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				$(this).html('Duplicate Email Address, Please Check agian.').addClass('messageboxerror').fadeTo(900,1);				
			});
			$('#messagebox').focus();
			
		
		}
		if (response==3)
		{
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				$(this).html('Data Updated Successfully.').addClass('messagebox_ok').fadeTo(900,1);
			
			});
		}
		else if (response==2)
		{
			
			alert('Registration successful, please activate email.');
			
			window.location = "http://www.uneleap.com/";
			
			$("#messagebox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
				$(this).html('Registration successful, please activate email.').addClass('messagebox_ok').fadeTo(900,1);
				$('#messagebox').focus();
				
				$('#name').val('');
			
				$('#email').val('');
				$('#password').val('');
				$('#confirm_password').val('');
				$('#country').val('');
			
				
				
				
			});
		}
	
	}
}	


