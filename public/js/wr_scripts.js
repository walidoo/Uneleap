function deleteNotification(id) {
	var notification_id = id;
	$.ajax({
		        type: 'delete',
		              url: '../delete_notify',
		              datatype: 'JSON',
		              data:{
		                  The_Id : notification_id,
		              },
		              success : function(data) {
		              	if( data.deleted == 1 ) {
		              		$("div.delete_notify").show();
		              		$("div.delete_notify p").text('deleted Successfully... Wait!');
		              		setTimeout(function(){
													window.location.reload(true);
												  }, 2000);
		              	}
		              }
		    });
}


$(document).ready(function(){
	//change the color for skills progree-bar
	$('.progress-bar-success').map(function(){
		var skill_value = $(this).attr('skill-val');
		if( skill_value == 0 || skill_value < 35 ) {
			$(this).filter(function(skill_value) {
				var x = $(this).attr("skill-val");
	        	return skill_value == 0 || skill_value < 35;
			}).css('background-color','red');
		} else if( skill_value == 35 || skill_value < 75 ) {
			$(this).filter(function(skill_value) {
				var y = $(this).attr("skill-val");
	        	return skill_value == 35 || skill_value < 75;
			}).css('background-color','yellow');
		} else if( skill_value == 75 || skill_value <= 100 ) {
			$(this).filter(function(skill_value) {
				var z = $(this).attr("skill-val");
	        	return skill_value == 75 || skill_value <= 100;
			}).css('background-color','green');
		}
	});

	//hide end_date when i'm currently working already checked
	/*if( $("input[name='is_currently_working']:checkbox:not(:checked)").val() == null ) {
		$("li.end-date").hide();
		$(".current-position").show();
	} if( $("input[name='is_currently_working']").val() == 'on' ) {
		$("li.end-date").show();
		$(".current-position").hide();
	}*/


	//Search for questions & library
	$(".target").on('change', function() {
		var searchKey = $(".target").val();
		var search_val = $("input[name='q']").val();
		if( searchKey == 1 ) {
		      var public_path = $("meta.public_path").attr('content');
		      $.ajax({
		        type: 'get',
		              url: './search/question',
		              datatype: 'JSON',
		              data:{
		                  question_search_key : searchKey,
		                  search_val : search_val
		              },
		              success : function(data) {
		                var xx;
		                var data_table = '';
		              if( data.question_search.length !== 0 ) {
		              for( xx in data.question_search ) {
		              data_table +=   '<div class="col-md-4 col-sm-6 col-xs-12">'+
		                            '<div class="info-box">'+
		                              '<span class="info-box-icon bg-green">';
		                              	data_table += '<i class="fa fa-question"></i>';
		                              	data_table += '</span>'+
		                              '<div class="info-box-content">'+
		                                '<span class="info-box-number"><a href="question/get/'+ data.question_search[xx].id +'">'+ data.question_search[xx].title +'</a></span><hr>'+
		                                '<span class="info-box-text"><b>Filter:</b> '+ data.question_search[xx].filter_name[0].filter +'</span>'+
		                                '<span class="info-box-text"><b>Description:</b> '+ data.question_search[xx].description +'</span>';
		                                '</div>'+
		                                '</div>'+
		                            '</div>';
		              }
		              } else {
		                data_table =   '<div class="col-md-6">'+
		                            '<h4>There are no questions matched with the search key!</h4>'+
		                            '</div>';
		              }
		              $("#q_result").html(data_table);
		              }
		      });
    	} else if( searchKey == 2 ) {
	      var public_path = $("meta.public_path").attr('content');
	      $.ajax({
	        type: 'get',
	              url: './search/library',
	              datatype: 'JSON',
	              data:{
	                  library_search_key : searchKey,
	                  search_val : search_val
	              },
	              success : function(data) {
	                var yy;
	                var data_table = '';
	              	if( data.library_search.length != 0 ) {
				      for( yy in data.library_search ) {
				                console.log(data.library_search[yy]);
				              data_table +=   '<div class="col-md-4 col-sm-6 col-xs-12">'+
				                            '<div class="info-box">'+
				                              '<span class="info-box-icon bg-green">';
				                              if( !data.library_search[yy].cover_photo ) {
				                                data_table += '<i class="fa fa-bookmark"></i></span>'+
				                                '<div class="info-box-content">'+
				                                '<span class="info-box-number"><a href="library/get/'+ data.library_search[yy].id +'">'+ data.library_search[yy].title +'</a></span><hr>'+
				                                '<span class="info-box-text"><b>Author:</b> '+ data.library_search[yy].author +'</span>'+
				                                '<span class="info-box-text"><b>Filter:</b> '+ data.library_search[yy].filter_name[0].filter +'</span>'+
				                                '<span class="info-box-text"><b>Description:</b> '+ data.library_search[yy].description +'</span>'+
				                                '</div>';
				                            } else {
				                              data_table += '<img src="'+ public_path+'/public/'+ data.library_search[yy].cover_photo +'" class="user-image" alt="User Image">';
				                              data_table += '</span>'+
				                              '<div class="info-box-content">'+
				                                '<span class="info-box-number"><a href="library/get/'+ data.library_search[yy].id +'">'+ data.library_search[yy].title +'</a></span><hr>'+
				                                '<span class="info-box-text"><b>Author:</b> '+ data.library_search[yy].author +'</span>'+
				                                '<span class="info-box-text"><b>Filter:</b> '+ data.library_search[yy].filter_name[0].filter +'</span>'+
				                                '<span class="info-box-text"><b>Description:</b> '+ data.library_search[yy].description +'</span>'+
				                              '</div>';
				                            }
				                            data_table += '</div>'+
				                          '</div>';
				      }
				  } else {
	                data_table =   '<div class="col-md-6">'+
	                            '<h4>There is no library matched with the search key!</h4>'+
	                            '</div>';
	              }
	              $("#q_result").html(data_table);
	              }
	      });
    	} else if( searchKey == 3 ) {
			var public_path = $("meta.public_path").attr('content');
			$.ajax({
				type: 'get',
					    url: './search/university',
					    datatype: 'JSON',
					    data:{
					        library_search_key : searchKey,
					        search_val : search_val
					    },
					    success : function(data) {
					    	var zz;
					    	var data_table = '';
							if( data.university_search.length != 0 ) {
							for( zz in data.university_search ) {
					    	console.log(data.university_search[zz]);
							data_table +=   '<div class="col-md-4 col-sm-6 col-xs-12">'+
									          '<div class="info-box">'+
									            '<span class="info-box-icon bg-green">';
									            if( data.university_search[zz].university_filter_data.length == 0 ) {
									            	data_table += '<i class="fa fa-university"></i></span>'+
									            	'<div class="info-box-content">'+
									              '<span class="info-box-number"><a href="user/university/page/'+ data.university_search[zz].id +'">'+ data.university_search[zz].name +'</a></span><hr>'+
									              '</div>';
									        	} else {
									        		data_table += '<img src="'+ public_path+'/public/'+ data.university_search[zz].university_filter_data[0].profile +'" class="user-image" alt="User Image">';
									            data_table += '</span>'+
									            '<div class="info-box-content">'+
									              '<span class="info-box-number"><a href="user/university/page/'+ data.university_search[zz].id +'">'+ data.university_search[zz].name +'</a></span><hr>'+
									              '<span class="info-box-text"><b>Email:</b> '+ data.university_search[zz].university_filter_data[0].email +'</span>'+
									              '<span class="info-box-text"><b>Address:</b> '+ data.university_search[zz].university_filter_data[0].address +'</span>'+
									              '<span class="info-box-text"><b>Website:</b> <a href="'+ data.university_search[zz].university_filter_data[0].website +'">'+ data.university_search[zz].university_filter_data[0].website +'</span>'+
									            '</div>';
									        	}
									          data_table += '</div>'+
									  			'</div>';
							}
							} else {
								data_table =   '<div class="col-md-6">'+
        										'<h4>There is no university matched with the search key!</h4>'+
        										'</div>';
							}
							$("#q_result").html(data_table);
					   	}
			});
		} else if( searchKey == 4 ) {
			var public_path = $("meta.public_path").attr('content');
			$.ajax({
				type: 'get',
					    url: './search/event',
					    datatype: 'JSON',
					    data:{
					        event_search_key : searchKey,
					        search_val : search_val
					    },
					    success : function(data) {
					    	console.log(data.event_search);
					    	var aaa;
					    	var data_table = '';
							if( data.event_search.length != 0 ) {
							for( aaa in data.event_search ) {
							data_table +=   '<div class="col-md-4 col-sm-6 col-xs-12">'+
									          '<div class="info-box">'+
									            '<span class="info-box-icon bg-green">';
									            if( data.event_search[aaa].cover_photo.length == 0 ) {
									            	data_table += '<i class="fa fa-calendar-check-o"></i>';
									        	} else {
									        		data_table += '<img src="'+ public_path +'/public/'+ data.event_search[aaa].cover_photo +'" class="user-image" alt="User Image">';
									        	}
									            data_table += '</span>'+
									            '<div class="info-box-content">'+
									              '<span class="info-box-number">'+ data.event_search[aaa].title +'</span><hr>'+
									              '<span class="info-box-text"><b>Start-Date:</b> '+ data.event_search[aaa].start_date +'</span>'+
									              '<span class="info-box-text"><b>End-Date:</b> '+ data.event_search[aaa].end_date +'</span>'+
									              '<span class="info-box-text"><b>Description:</b> '+ data.event_search[aaa].description +'</span>'+
									              '</div>'+
									          	  '</div>'+
									  			  '</div>';
							}
							} else {
								data_table =   '<div class="col-md-6">'+
        										'<h4>There are no events matched with the search key!</h4>'+
        										'</div>';
							}
							$("#q_result").html(data_table);
					   	}
			});
		}

	});


	
	//Send ajax Message
	$('button#send_msg').on('click', function(e) {
		e.preventDefault();
		var the_reciever_id = $("input[name='receiver_id']").val();
		var msg = $("input[name='message']").val();
		$.ajax({
		        	  type: 'get',
		              url: './send',
		              datatype: 'JSON',
		              data:{
		                  receiver_id : the_reciever_id,
		                  message : msg,
		              },
		              success : function(data) {
		              	console.log(data.question_search);
		              }
		    	});
	});



//End
});

