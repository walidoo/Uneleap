function show_div(div)
{
	document.getElementById(div).style.visibility = 'visible';
	//return;
}
function hide_div(div)
{
	document.getElementById(div).style.visibility = 'hidden';
	//return;
}
//------------------------------------------------------------------------------------------------------------------------------------------- Form Serach List View show starts Here 

function showResult(str,type,div)
{

if (str.length==0)
  {
  document.getElementById(div).innerHTML="";
  document.getElementById(div).style.border="0px";
  return;
  }
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
    document.getElementById(div).innerHTML=xmlhttp.responseText;
    document.getElementById(div).style.border="1px solid #A5ACB2";
    }
  }
  //alert(type);
xmlhttp.open("GET","list_view_style.php?search_string="+trim(str)+"&type="+type,true);
xmlhttp.send();

}

function showResultTeamMember(str,type,div)
{
	
if (str.length==0)
  {
  document.getElementById(div).innerHTML="";
  document.getElementById(div).style.border="0px";
  return;
  }
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
    document.getElementById(div).innerHTML=xmlhttp.responseText;
    document.getElementById(div).style.border="1px solid #A5ACB2";
    }
  }
  //alert(type);
xmlhttp.open("GET","list_view_style.php?search_string="+trim(str)+"&type="+type,true);
xmlhttp.send();

}

function showResultSample(str,str2,type,div)
{
	
if (str.length==0)
  {
  document.getElementById(div).innerHTML="";
  document.getElementById(div).style.border="0px";
  return;
  }
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
    document.getElementById(div).innerHTML=xmlhttp.responseText;
    document.getElementById(div).style.border="1px solid #A5ACB2";
    }
  }
  //alert(type);
xmlhttp.open("GET","list_view_sample.php?search_string="+trim(str)+"&search_string2="+str2+"&type="+type,true);
xmlhttp.send();
}

//---------------------------------------------------------------------------User Privi List view start

function showResult_userpriv(str,str2,type,div)
{
	
if (str.length==0)
  {
  document.getElementById(div).innerHTML="";
  document.getElementById(div).style.border="0px";
  return;
  }
  if (str2.length==0)
  {
  document.getElementById(div).innerHTML="";
  document.getElementById(div).style.border="0px";
  return;
  }
  
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
    document.getElementById(div).innerHTML=xmlhttp.responseText;
    document.getElementById(div).style.border="1px solid #A5ACB2";
    }
  }
  //alert(type);
xmlhttp.open("GET","list_view.php?q="+trim(str)+"&qq="+trim(str2)+"&type="+type,true);
xmlhttp.send();
}
//------------------------------------------------------------------------------------------------------------------------------------------- Form search List View  and show Ends Here 
//------------------------------------------------------------------------------------------------------------------------------------------- Load page in a div from drop down search
function loadpage_data(str,usr)
{
		//alert(usr);
if (str=="")
  {
  document.getElementById("user_prev").innerHTML="";
  return;
  }
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
    document.getElementById("user_prev").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","show_previledge.php?user="+usr+"&mod="+str,true);
xmlhttp.send();
}

//------------------------------------------------------------------------------------------------------------------------------------------- Form Refresh and Back Starts Here 


function checkKeycode(e,type) 
{
	var keycode;
	var type=type;
	if (window.event)
	{
		keycode = window.event.keyCode;
		if(keycode == 116)
		{
			window.event.keyCode=0;
		}
	}

	else if (e) keycode = e.which;

//alert(keycode);
	if(keycode == 114)
	{
	
	return false;
	}
	if(keycode == 116)
	{
	
	return false;
	}

	if(keycode == 117){
	
	return false;
	window.event.keyCode=0;
	}
	
	
	if(keycode == 8){
	//alert('Use Delete to erase data');
	return false;
	window.event.keyCode=0;
	
	} 
	//var id=type;
	
	if(keycode == 119){
		
			//alert(id);
			return_next_id_module(type);
		return_next_id();
	}
}
//------------------------------------------------------------------------------------------------------------------------------------------- Form Refresh and Back Ends Here 

//-------------------------------------------------------------------------------------------------------------------------------------------Supporting Form Value Fill Starts Here 

	var ajax = new sack();
	var currentClientID=false;
//.........................................Style Info Start........................................................................................
	
	function getDataStyleMst(id,type)
	{
		
		//var clientId = id;
		ajax.requestFile = 'get_data_update.php?getClientId='+id+'&type='+type;	// Specifying which file to get
		
		ajax.onCompletion = showClientData;	// Specify function that will be executed after file has been found
		ajax.runAJAX();	
		
	}
	
	function showClientData()
	{
		var formObj = document.forms['style_info'];
		eval(ajax.response);
			
	}

//.........................................Style Info End..................................................................

//.........................................Trim Info Start..................................................................

	function getClientDataTrim(id,type)
	{

			ajax.requestFile = 'get_data_update.php?getClientId='+id+'&type='+type;	// Specifying which file to get
			ajax.onCompletion = showClientDataTrim;	// Specify function that will be executed after file has been found
			ajax.runAJAX();	
			
	}
	
	function showClientDataTrim()
	{
		//alert(ajax.response);
		var formObj = document.forms['trim_info'];
		eval(ajax.response);
			
	}
//.........................................Trim Info End..................................................................

//.........................................Item master Info Start..................................................................

	function getClientDataItemMaster(id,type)
	{

			ajax.requestFile = 'get_data_update.php?getClientId='+id+'&type='+type;	// Specifying which file to get
			ajax.onCompletion = showClientDataItemMaster;	// Specify function that will be executed after file has been found
			ajax.runAJAX();	
			
	}
	
	function showClientDataItemMaster()
	{
		var formObj = document.forms['item_master'];
		eval(ajax.response);
			
	}
//.........................................Item master  End..................................................................

//.........................................Marchect team Start..................................................................
	
	
	function getClientDatamktTeam(id,type)
	{

			ajax.requestFile = 'get_data_update.php?getClientId='+id+'&type='+type;	// Specifying which file to get
	
			ajax.onCompletion = showClientDatamktTeam;	// Specify function that will be executed after file has been found
			ajax.runAJAX();	
			
	}
	
	function showClientDatamktTeam()
	{
		var formObj = document.forms['marchant_team_info'];
		eval(ajax.response);
		showResultTeamMember(document.getElementById('txt_mst_id').value,'5','member_list_view');
			
	}
//.........................................Marchect team  End..................................................................	
	
//.........................................Marchect team Dtls Start..................................................................

	function getClientDatamktTeamDtls(id,type)
	{

			ajax.requestFile = 'get_data_update.php?getClientId='+id+'&type='+type;	// Specifying which file to get
			ajax.onCompletion = showClientDatamktTeamDtls;	// Specify function that will be executed after file has been found
			ajax.runAJAX();	
			
	}
	
	function showClientDatamktTeamDtls()
	{
		var formObj = document.forms['marchant_team_info_det'];
		eval(ajax.response);
		//showResultTeamMember(document.getElementById('txt_mst_id').value,'5','member_list_view');
		
	}
	
//.........................................Marchect team Dtls End.................................................................	
	
//---------------------------Sample Info Start-----------------------------------------------------------------------
	function getSampleClientData(id,type)
	{
		ajax.requestFile = 'get_data_update.php?getClientId='+id+'&type='+type;	// Specifying which file to get
		ajax.onCompletion = showSampleClientData;	// Specify function that will be executed after file has been found
		ajax.runAJAX();	
	}
	
	function showSampleClientData()
	{
		var formObj = document.forms['sample_info'];
		eval(ajax.response);
			
	}
//---------------------------Sample Info End-----------------------------------------------------------------------	
	function getMenuData(id,type)
	{
		var clientId = id;//document.getElementById('clientID').value.replace(/[^0-9]/g,'');
		ajax.requestFile = 'get_data_update.php?getClientId='+clientId+'&type='+type;	// Specifying which file to get
		
		ajax.onCompletion = showmenuData;	// Specify function that will be executed after file has been found
		ajax.runAJAX();	
			
	}
	
	function showmenuData()
	{
		var formObj = document.forms['menu_create'];
		eval(ajax.response);
			
	}
	//------------------------------------------------------------------------------------------------------------------------------------- Form Field Fill User Entry Employee

//.........................................Standard CM Entry Start........................................................................................
	
	function getDataStandardMst(id,type)   
	{
		ajax.requestFile = 'get_data_update.php?getClientId='+id+'&type='+type;	// Specifying which file to get
		ajax.onCompletion = showClientDatastandardMst;	// Specify function that will be executed after file has been found
		ajax.runAJAX();	
	}
	
	function showClientDatastandardMst()
	{
		var formObj = document.forms['standard_cm_entry'];
		eval(ajax.response);
		//alert('gg');
		//showResult(document.getElementById('txt_mst_id').value,'4','sewing_line_list_view');
	}  
	
	//.........................................Standard CM Entry end........................................................................................







	function get_emp_user_Data(id,type)
	{
		var clientId = id;//document.getElementById('clientID').value.replace(/[^0-9]/g,'');
		ajax.requestFile = 'get_data_update.php?getClientId='+clientId+'&type='+type;	// Specifying which file to get
		
		ajax.onCompletion = showuser_emp;	// Specify function that will be executed after file has been found
		ajax.runAJAX();	
			
	}
	
	function showuser_emp()
	{
		var formObj = document.forms['user_create'];
		eval(ajax.response);
			
	}
	
	
	
function sack(file) {
	this.xmlhttp = null;

	this.resetData = function() {
		this.method = "POST";
  		this.queryStringSeparator = "?";
		this.argumentSeparator = "&";
		this.URLString = "";
		this.encodeURIString = true;
  		this.execute = false;
  		this.element = null;
		this.elementObj = null;
		this.requestFile = file;
		this.vars = new Object();
		this.responseStatus = new Array(2);
  	};

	this.resetFunctions = function() {
  		this.onLoading = function() { };
  		this.onLoaded = function() { };
  		this.onInteractive = function() { };
  		this.onCompletion = function() { };
  		this.onError = function() { };
		this.onFail = function() { };
	};

	this.reset = function() {
		this.resetFunctions();
		this.resetData();
	};

	this.createAJAX = function() {
		try {
			this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e1) {
			try {
				this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {
				this.xmlhttp = null;
			}
		}

		if (! this.xmlhttp) {
			if (typeof XMLHttpRequest != "undefined") {
				this.xmlhttp = new XMLHttpRequest();
			} else {
				this.failed = true;
			}
		}
	};

	this.setVar = function(name, value){
		this.vars[name] = Array(value, false);
	};

	this.encVar = function(name, value, returnvars) {
		if (true == returnvars) {
			return Array(encodeURIComponent(name), encodeURIComponent(value));
		} else {
			this.vars[encodeURIComponent(name)] = Array(encodeURIComponent(value), true);
		}
	}

	this.processURLString = function(string, encode) {
		encoded = encodeURIComponent(this.argumentSeparator);
		regexp = new RegExp(this.argumentSeparator + "|" + encoded);
		varArray = string.split(regexp);
		for (i = 0; i < varArray.length; i++){
			urlVars = varArray[i].split("=");
			if (true == encode){
				this.encVar(urlVars[0], urlVars[1]);
			} else {
				this.setVar(urlVars[0], urlVars[1]);
			}
		}
	}

	this.createURLString = function(urlstring) {
		if (this.encodeURIString && this.URLString.length) {
			this.processURLString(this.URLString, true);
		}

		if (urlstring) {
			if (this.URLString.length) {
				this.URLString += this.argumentSeparator + urlstring;
			} else {
				this.URLString = urlstring;
			}
		}

		// prevents caching of URLString
		this.setVar("rndval", new Date().getTime());

		urlstringtemp = new Array();
		for (key in this.vars) {
			if (false == this.vars[key][1] && true == this.encodeURIString) {
				encoded = this.encVar(key, this.vars[key][0], true);
				delete this.vars[key];
				this.vars[encoded[0]] = Array(encoded[1], true);
				key = encoded[0];
			}

			urlstringtemp[urlstringtemp.length] = key + "=" + this.vars[key][0];
		}
		if (urlstring){
			this.URLString += this.argumentSeparator + urlstringtemp.join(this.argumentSeparator);
		} else {
			this.URLString += urlstringtemp.join(this.argumentSeparator);
		}
	}

	this.runResponse = function() {
		eval(this.response);
	}

	this.runAJAX = function(urlstring) {
		if (this.failed) {
			this.onFail();
		} else {
			this.createURLString(urlstring);
			if (this.element) {
				this.elementObj = document.getElementById(this.element);
			}
			if (this.xmlhttp) {
				var self = this;
				if (this.method == "GET") {
					totalurlstring = this.requestFile + this.queryStringSeparator + this.URLString;
					this.xmlhttp.open(this.method, totalurlstring, true);
				} else {
					this.xmlhttp.open(this.method, this.requestFile, true);
					try {
						this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
					} catch (e) { }
				}

				this.xmlhttp.onreadystatechange = function() {
					switch (self.xmlhttp.readyState) {
						case 1:
							self.onLoading();
							break;
						case 2:
							self.onLoaded();
							break;

						case 3:
							self.onInteractive();
							break;
						case 4:
							self.response = self.xmlhttp.responseText;
							self.responseXML = self.xmlhttp.responseXML;
							self.responseStatus[0] = self.xmlhttp.status;
							self.responseStatus[1] = self.xmlhttp.statusText;

							if (self.execute) {
								self.runResponse();
							}

							if (self.elementObj) {
								elemNodeName = self.elementObj.nodeName;
								elemNodeName.toLowerCase();
								if (elemNodeName == "input"
								|| elemNodeName == "select"
								|| elemNodeName == "option"
								|| elemNodeName == "textarea") {
									self.elementObj.value = self.response;
								} else {
									self.elementObj.innerHTML = self.response;
								}
							}
							if (self.responseStatus[0] == "200") {
								self.onCompletion();
							} else {
								self.onError();
							}

							self.URLString = "";
							break;
					}
				};

				this.xmlhttp.send(this.URLString);
			}
		}
	};

	this.reset();
	this.createAJAX();
}
//-------------------------------------------------------------------------------------------------------------------------------------------Supporting Form Value Fill Ends Here 

//-------------------------------------------------------------------------------------------------------------------------------------------Check Numeric Value starts


function IsNumeric(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
   }
//-------------------------------------------------------------------------------------------------------------------------------------------Check Numeric Value Ends
//-------------------------------------------------------------------------------------------------------------------------------------------load Drop Down List Value Starts


function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function load_drop_down(distId,type,div) {		
		
		var strURL="ajax_dropdown_loader.php?type="+type+"&distId="+distId;
		var req = getXMLHTTP();
		//alert(div);
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById(div).innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
	
	
	//-------------------------------------------------------------------------------------------------------------------------------------------load Drop Down List Value ends
	
	
	
function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function ltrim(stringToTrim) {
	return stringToTrim.replace(/^\s+/,"");
}
function rtrim(stringToTrim) {
	return stringToTrim.replace(/\s+$/,"");
}

//-------------------------------------------------------------------------------------------------------------------------------------------Return Next ID
function return_next_id(type) 
{
		//alert(type);
		vid1=document.getElementById('cbo_module_name').value;
		vid2=document.getElementById('cbo_root_menu').value;
		vid3=document.getElementById('cbo_root_menu_under').value;
		type='1';
		///alert(vid2);
		var strURL="ajax_next_id.php?type="+type+"&vid1="+vid1+"&vid2="+vid2+"&vid3="+vid3;
		var req = getXMLHTTP();
		
		if (req) 
		{
			req.onreadystatechange = function() 
			{
				if (req.readyState == 4) 
				{
					// only if "OK"
					if (req.status == 200) 
					{						
						document.getElementById('menu_seq_menu_create').innerHTML=req.responseText;						
					} 
					else 
					{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function return_next_id_module() 
{
		
		type='2';
		//alert(vid1);
		var strURL="ajax_next_id.php?type="+type;
		var req = getXMLHTTP();
		
		if (req) 
		{
			req.onreadystatechange = function() 
			{
				if (req.readyState == 4) 
				{
					// only if "OK"
					if (req.status == 200) 
					{						
						document.getElementById('mod_seq_mod_create').innerHTML=req.responseText;						
					} 
					else 
					{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}

//Change ITem Category...

function item_category_add(str,type)
{
//var sel = document.getElementById("cbo_item_category");
//var myTest  =sel.options[sel.selectedIndex].value;
	//alert(str);
	
	if(str==4)
	{
			
		//$('#fancy_item_tr_id').show();
		document.trim_info.cbo_fancy_item.disabled=false;
		document.trim_info.cbo_trim_type.disabled=false;
		document.trim_info.cbo_order_uom.disabled=false;
		document.trim_info.cbo_trim_uom.disabled=false;
		document.trim_info.txt_conversion_factor.disabled=false;
	}
	else if(str==5 || str==6 || str==7 )
	{ 
		//$('#fancy_item_tr_id').hide(); 
		document.trim_info.cbo_fancy_item.disabled=true;
		document.trim_info.cbo_fancy_item.value=0;
		
		document.trim_info.cbo_trim_type.disabled=true;
		document.trim_info.cbo_trim_type.value=0;
		
		document.trim_info.cbo_order_uom.disabled=false;
		document.trim_info.cbo_trim_uom.disabled=false;
		document.trim_info.txt_conversion_factor.disabled=false;
	}
	else
	{ 
		//$('#fancy_item_tr_id').hide(); 
		document.trim_info.cbo_fancy_item.disabled=true;
		document.trim_info.cbo_fancy_item.value=0;
		
		document.trim_info.cbo_trim_type.disabled=true;
		document.trim_info.cbo_trim_type.value=0;
		
		document.trim_info.cbo_order_uom.disabled=true;
		document.trim_info.cbo_order_uom.value=0;
		
		document.trim_info.cbo_trim_uom.disabled=true;
		document.trim_info.cbo_trim_uom.value=0;
		
		document.trim_info.txt_conversion_factor.disabled=true;
		document.trim_info.txt_conversion_factor.value="";
	}
	item_category_add1(str,7);
}

function onlyNumbers(evt)
{
	var e = event || evt; // for trans-browser compatibility
	var charCode = e.which || e.keyCode;

	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}


function item_category_add1(id,type)
{
	var clientId = id;
	ajax.requestFile = 'get_data_update.php?getClientId='+clientId+'&type='+type;	// Specifying which file to get
	ajax.onCompletion = item_response;	// Specify function that will be executed after file has been found
	ajax.runAJAX();	
		
}

function item_response()
{
	var formObj = document.forms['trim_info'];
	eval(ajax.response);
		
}