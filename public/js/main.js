$(document).ready(function() {

  function init()  {
    $('#enabled').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });
    $('.new-btn').hide();
  }

  function stopPropa(e)  {
    if (e.stopPropagation){
       e.stopPropagation();
     } else if(window.event){
        window.event.cancelBubble=true;
     }
  }


  function fillForm(user, newUser)
  {
    if(!newUser){
      $('<input>').attr({
        type: 'hidden',
        id: 'id',
        name: 'id',
        value: user.id
      }).appendTo('.userForm');
    }else{
      $('.userForm').find("input[name=id]").remove();
    }
    $("#name").val(user.name);
    $("#email").val(user.email);
    var enabled = user.enabled == null || user.enabled == 0 ? 'off' : 'on';
    $("#enabled").bootstrapToggle(enabled);
    if(newUser){
      $(".new-btn").hide();
      $(".password-group").show();
    }
    else {
      $('.new-btn').show();
      $(".password-group").hide();
    }
  }
  function clearForm(){
    var user = {
      name : "",
      email : "",
      id : null,
      enabled : null ,
    };
    fillForm(user, true);
  }
  
    function deleteUser(id) {
      var d = {"id":id , "_token": $("meta[name='csrf-token']").attr("content")};
      $.post("/user/delete", d)
      .done(function(data){})
      .complete(function(){
        refreshUsers()
      });
    }

    function enableUser(id,enabled)  {
      var d = {"id":id ,
               "enabled": enabled ? "on" : "off",
               "_token": $("meta[name='csrf-token']").attr("content")};
      $.post("/user/enable",d)
      .done(function(data){})
      .complete(function(){
        refreshUsers()
      });
    }

  function editUser(id)  {
    var d = {"id":id ,
             "_token": $("meta[name='csrf-token']").attr("content")};
    $.get("/users/"+id)
    .done(function(data){
      fillForm(data, false);
    })
    .complete(function(){});
  }

  function refreshUsers()  {
		var list = $(".list-div");
		list.empty();
		list.append(' <div class="row"> Loading ... </div>');

    	$.get("/users")
    	.done(function(data){
    		list.empty();
        list.html(data);
        $('.enabled').bootstrapToggle({on: 'Enabled', off: 'Disabled' });
        $('.enabled-group').on('click',function(e){
          stopPropa(e);
          $(this).find(".enabled").bootstrapToggle('toggle');
        });
        $('.enabled').change(function(){
          enableUser($(this).closest('li').data().id, $(this).is(":checked"));
        });
        $('.list-group-item').on('click',function(e){
          stopPropa(e);
          editUser($(this).data().id);
        });
        $('.delete').on('click', function(e){
          stopPropa(e);
          if(confirm('Delete user?')){
            deleteUser($(this).parent().data().id);
          }
        });
    	});
    }

    init();
    refreshUsers();

    $(".new-btn").click(function(){
      clearForm();
      $(this).hide();
    });

    $(".save-btn").click(function(){
    	console.log("sumit");
      var d =  $(".userform").serialize();
      var id = $(".userForm").data().id;
      if(id != null && id != undefined) d.id = id;

    	$.post("users", d)
    	.done(function(data) {
    		console.log("data" + data);
        $("#alertDiv").bs_info('User saved!', 'Success');
    	})
    	.fail(function(){
        $("#alertDiv").bs_alert('Problem saving data', 'Error');
    	})
    	.always(function(){
    		refreshUsers();
    	});
    });

});
