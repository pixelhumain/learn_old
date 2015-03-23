
<!-- *** TODO *** -->
<div id="newTodo">
	<div class="noteWrap col-md-4 col-md-offset-4">
		<h3>Add new todo</h3>
		<form class="form-todo">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input id="todoId"  type="hidden">
						<input class="form-control" id="todoName" type="text" placeholder="Todo Name...">
						<input id="todoType" value="todo" type="hidden">
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="btn-group">
					<a href="#" class="btn btn-info close-subview-button">
						Close
					</a>
				</div>
				<div class="btn-group">
					<button class="btn btn-info save-new-todo" type="submit">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
var dataBindTodo = {
	"#todoName" : "name",
	"#todoType" : "type"
};
jQuery(document).ready(function() {
 	
 	$(".new-todo").off().on("click", function() {
		subViewElement = $(this);
		subViewContent = subViewElement.attr('href');
		$.subview({
			content : subViewContent,
			onShow : function() {
				clearTodoForm();
				bindTodoSubViewEvents()
			},
			onHide : function() {
				$.hideSubview();
			},
			onSave: function() {
				$.hideSubview();
			}
		});
	});

});

function bindTodoSubViewEvents() {
		
	runTodoFormValidation();

	$(".close-subview-button").off().on("click", function(e) {
		$(".close-subviews").trigger("click");
		e.preventDefault();
	});
};

//validate new todo form
function runTodoFormValidation(el) {
	var formTodo = $('.form-todo');
	var errorHandler2 = $('.errorHandler', formTodo);
	var successHandler2 = $('.successHandler', formTodo);

	formTodo.validate({
		errorElement : "span", // contain the error msg in a span tag
		errorClass : 'help-block',
		errorPlacement : function(error, element) {// render error placement for each input type
			if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
				error.insertAfter($(element).closest('.form-group').children('div').children().last());
			} else if (element.parent().hasClass("input-icon")) {

				error.insertAfter($(element).parent());
			} else {
				error.insertAfter(element);
				// for other inputs, just perform default behavior
			}
		},
		ignore : "",
		rules : {
			todoName : {
				minlength : 2,
				required : true
			}
		},
		messages : {
			todoName : "* Please specify your todo"

		},
		invalidHandler : function(todo, validator) {//display error alert on form submit
			successHandler2.hide();
			errorHandler2.show();
		},
		highlight : function(element) {
			$(element).closest('.help-block').removeClass('valid');
			// display OK icon
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
			// add the Bootstrap error class to the control group
		},
		unhighlight : function(element) {// revert the change done by hightlight
			$(element).closest('.form-group').removeClass('has-error');
			// set error class to the control group
		},
		success : function(label, element) {
			label.addClass('help-block valid');
			// mark the current input as valid and display OK icon
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
		},
		submitHandler : function(form) {
			successHandler2.show();
			errorHandler2.hide();
			
			$.blockUI({
				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
	              '<cite title="Hegel">Hegel</cite>'+
	            '</blockquote> '
			});
			
			/* **************************************
			*	SAVE TODO
			***************************************** */
			buildAndSaveTodo();
		}
	});
}


function clearTodoForm()
{
	$.each(dataBindTodo,function(key,val){
		if(key != "")
			$(key).val("");
	});
}

function buildAndSaveTodo(rebuild)
{
	var todo = {};
	console.log( "save Todo " );
	$.each(dataBindTodo,function(key,val){
		//console.log("save Todo key ",key,val);
		if(key != "" )
		{
			if( $(key) && $(key).val() && $(key).val() != "" )
			{
				value = $(key).val();
				jsonHelper.setValueByPath( todo, val, value );
			} 
		}
		else
			console.log("save Todo Error",key);
	});
	console.dir( todo );
    saveTodo(todo,rebuild);
}

//Save any activity to database using ajax
function saveTodo(todo,closeSV)
{
	var params = {"todo":todo };
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+'/todo/save',
        dataType : "json",
        data : params,
		type:"POST",
    })
    .done(function (data) 
    {
    	$.unblockUI();
        if (data &&  data.result) {               
        	toastr.success('Todo Created success');
        	$.hideSubview();
        	console.log("updateTodo");
        	if(updateTodo != undefined && typeof updateTodo == "function")
        		updateTodo( todo , data.id );
        } else 
           toastr.error('Something Went Wrong : '+data.msg);
    });
}

function deleteTodo(todoId)
{
	bootbox.confirm("Are you sure ?"+todoId, function(result) {
		if(result)
		{
			var params = {"id" : todoId };
			testitpost("null",baseUrl+"/"+moduleId+"/todo/delete",params,function(data,id){
				if(!data.result)
					toastr.error(data.msg);
				else{	
					toastr.success(data.msg);
			        //delete todos[todoId];
			        console.log("deleted todo",todoId);
				}
			});
		} 
	});
}

/*editTodoId = null;
function editTodo(todoObj)
{
	//clearAddSiteForm(false);
	if( todoObj && todoObj['_id'] && todoObj['_id']["$id"])
	{
		console.log("editTodo",todoObj['_id']["$id"]);
		editTodoId = todoObj['_id']["$id"];
		$.subview({
	        content : ".form-todo",
	        onShow : function() {
				$.each(dataBindTodo,function(key,val){
					//console.log("editTodo key",key);
					if(key != "")
						$(key).val( jsonHelper.getValueByPath( todoObj, val ) );
				});
				
			    bindTodoSubViewEvents();
	        },
	        onSave : function() {
	            buildAndSaveTodo();
	        }
	    });
    } else {
		toastr.error('The project Object is undefined!');
		console.dir(todoObj);
	}  
}*/
</script>