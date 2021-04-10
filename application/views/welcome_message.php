<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Real Time Table</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}
	.name{
		text-transform:uppercase;
		font-weight:bold;
	}
	#container{
		display:flex;
		justify-content:center;
	}
	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
	tr {
    background-color: white;
    transition: background-color 1s;
}

	.down{
		background:#ffc7ce;
		 transition: background-color 1s;
		color:#9c0006;
	}
	.up{
		background:#c6efce;
		 transition: background-color 1s;
		color:#006100;
	}
	.card-title{
	
	align-items: center;
    display: flex;
    justify-content: space-between;
	}
	.card_user{
		display:flex;
		align-items:center;
		padding:20px 0;
	}
	.card_user span {
		padding:0 6px;
	}
	</style>
</head>
<body>

<div id="container">
	<div class="card" style="width: 100%;">
  <div class="card-body">
    <div class="card-title">
	<h5>Real Time Values Update</h5>
	<button type="button" class="btn btn-primary" id="add_post">
  		Add Post
	</button>
	 </div>
   
   <!-- table -->
	<table class="table table-hover table-sm">
  <thead>
    <tr>
      <th scope="col">Rank</th>
      <th scope="col">Username</th>
      <th scope="col">Count</th>
    </tr>
  </thead>
  	<tbody id="table_body">
   
     
  	</tbody>
</table>


   <!-- table -->
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
			<select class="form-control" name="user_id" value="" id="users_radio">
			
			</select>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit"  class="btn btn-primary">Save</button>
      </div>
		</form>
      </div>
    
    </div>
  </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

$(document).ready(function(){
window.ranks=[];
window.executed = false;

		$("form").submit(function(e){
			e.preventDefault();
			
			$.ajax({
				type: 'post',
				url: 'http://localhost/realTimeTable/index.php/welcome/updatePost',
				data: $('form').serialize(),
				success: function (data) {
					$('#exampleModal').modal('toggle');
				}
			});
		});

	$.ajax({
		url:'http://localhost/realTimeTable/index.php/welcome/data',
		method:'GET',
		data:{},
		success:function(data){
			data.forEach(function(user,index){
				ranks['user_'+user.id] = index+1; 
				$('#table_body').append(`
					<tr id="${user.id}">
						<td>${index+1}</td>
						<td class="name">${user.user_name}</td>
						<td>${user.count}</td>
					
					</tr>
				`)
			});
	
		}
	})


	$('#add_post').on('click',function(){
		$('#exampleModal').modal('toggle');

		$.ajax({
		url:'http://localhost/realTimeTable/index.php/welcome/users',
		method:'GET',
		data:{},
		success:function(data){
			$('#users_radio option').remove();
			data.forEach(function(user){

				$('#users_radio').append(`	
					<option value="${user.id}">${user.user_name}</option>
				`)

			});
		}
	})

	})
});
var removeClass = function() {

        if (!executed) {
            executed = true;
			
            $(`tr`).removeClass('up');
			$(`tr`).removeClass('down');
        }
    
};

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('bc4db7f18d4aee9b3940', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
	
     data.user.forEach(function(user,index){
		
		row =$('#table_body').find('tr').eq(index);
		
		
		var tr_id= row.attr('id');
		if(tr_id != user.id){
		
			removeClass();
		
		
			var _class='';
			if(ranks['user_'+user.id] > index+1)
				 _class= 'up';
			else
				 _class= 'down';
			row.replaceWith(`<tr id="${user.id}" class="${_class}">
								<td>${index+1}</td>
								<td class="name">${user.user_name}</td>
								<td>${user.count}</td>
								
							</tr>`);
					
		
		}else{
		let	td=	$(`#${user.id}`).find("td:eq(2)");
			if(td.text() != user.count)
					td.text(user.count)
		}
			
	
			});

	setTimeout(() => {
		 $(`tr`).removeClass('up');
			$(`tr`).removeClass('down');
	}, 5000);
//  $(".up").delay(1500).fadeOut("slow");
			data.user.forEach(function(user,index){
				ranks['user_'+user.id] = index+1; });
				executed=false;
    });
  </script>
</body>
</html>