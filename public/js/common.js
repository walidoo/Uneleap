var preViousPage = 1;
var preViousPageSize = 10;
var isClear =0;
var isCalled =1;

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

var AjaxModule = {
	getRequest : function(){

	},
	postRequest : function(url,type,params){
		$.ajax({
		        type: type,
	            url : url,
	            data: { _token:$('input[name=_token]').val(),data:params.data},
	            beforeSend: function()
	            {
	               //$('.loader').show()
	               var loader =  $("#loader");
              	   loader.show();
	            },
	            complete: function(){
	             	$('#loader').fadeOut(600);
	            }

		        }).done(function (data) {
		            $(params.data['ResultDiv']).html(data);
		            location.hash = 1;
		        }).fail(function () {
		            alert('Posts could not be loaded.');
		        });
	},
	jsonRequest: function(url, type, params){
	    $.ajax({
	            type: type,
	            url : url,
	            data: { _token:$('input[name=_token]').val(),data:params.data},
	            dataType: 'json',
	            beforeSend: function()
	            {
	               var loader =  $("#loader");
              	   loader.show();
	            },
	            complete: function(){
		            $('#loader').fadeOut(600);
	            }

	        }).done(function (data) {
	            $(params.data['ResultDiv']).html(data);
	            location.hash = 1;
	        }).fail(function () {
			alert('Posts could not be loaded.');
	        });
	  },
	  initiateRequest : function(){
		var search_parameters = new Array();
		$(".search-filters-cls").each(function(){
			var name = $(this).attr('name');
			var id = $(this).attr('id');
			var value = $(this).val();
			var clause = new Object();

			if(value!="")
			{
				clause.key=name;
				clause.value=value;
				search_parameters.push(clause);
			}

		});

		return search_parameters;
	},
	postRequestReturnResponse : function(url,type,params, callbacks,isLoader)
	{
		var response = [];

		$.ajax({
		        type: type,
	            url : url,
	            data: { _token:$('input[name=_token]').val(),data:params.data},
	            beforeSend: function()
	            {
                    if (typeof isLoader !== 'undefined') {
                        if(isLoader==true) {
                            var loader = $("#loader");
                            loader.show();
                        }
                    }
                    else{
                        var loader = $("#loader");
                        loader.show();
                    }
                },
	            complete: function()
	            {
		            $('#loader').fadeOut(600);
	            }
		        }).done(function (data) {
	            	if (callbacks){
	            		callbacks.fire(data);
	            	}
		        }).fail(function (data) {
					        console.log("AJAX FAILED");
                            console.log(data);
                            window.location.reload();
		        });
		  return response;
	},
	submitform : function(form,url,callbacks)
	{
		$.ajax({
	        url: url, // Url to which the request is send
	        type: "POST",             // Type of request to be send, called as method
	        data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	        contentType: false,       // The content type used when sending data to the server.
	        cache: false,             // To unable request pages to be cached
	        processData:false,
	        beforeSend: function()
	            {
	               var loader =  $("#loader");
	               loader.show();
	            },
	            complete: function()
	            {
		            $('#loader').fadeOut(600);
	            }
		        }).done(function (data) {
	            	if (callbacks){
	            		callbacks.fire(data);
	            	}
		        }).fail(function (data) {
		            alertify.alert('Opps,Something went wrong.Please Try again !!');
		        });
	},
	initiateSearchRequest : function(page,isSearch,params)
  	{
  	  var pagesize=$( "#pagesize" ).val();
	  if(preViousPage!=page || preViousPageSize!=pagesize || (null != isSearch) || isClear==1)
	  {
	  	if(isClear==1){isClear=0;}

	    var clasuses=AjaxModule.initiateRequest();
	    params['data']['clasuses'].forEach(function(item)
	    {
	      clasuses.push(item);
	    });
	    params['data']['clasuses']=clasuses;
	    params['data']['page']=page;
	    params['data']['pagesize']=pagesize;
	    AjaxModule.jsonRequest('/search?sort=created_at&page='+page,'POST',params);
	   }
	    preViousPage=page;
	    preViousPageSize=$( "#pagesize" ).val();
  	}
};

    $(document).ready(function(){
        $(document).on('click', '.pagination a', function (e)
        {
			if(isCalled){
            	getPosts($(this).attr('href').split('page=')[1]);
			}
			e.preventDefault();
        });
	    $("#pagesize").on('change',function()
	    {
	        getPosts(1);
	    });
	    $(document).on('click', '#clear-btn', function (e)
        {
           $(".search-filters-cls").each(function(){
		      $(this).val('');
		    });
           isClear=1;
		   getPosts(1);
        });

			// Mobile menu handle
			$(document).on('click', '.Header-menuIcon', function (e) {
				e.preventDefault();
				$('.Header').toggleClass('is-menuOpen');
			})


    });
