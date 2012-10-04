$j(document).ready(function(){
	
	//dual box
	var db = $j('#dualselect').find('.ds_arrow .arrow');	//get arrows of dual select
	var sel1 = $j('#dualselect select:first-child');		//get first select element
	var sel2 = $j('#dualselect select:last-child');			//get second select element
	
	sel2.empty(); //empty it first from dom.
	
	db.click(function(){
		var t = ($j(this).hasClass('ds_prev'))? 0 : 1;	// 0 if arrow prev otherwise arrow next
		if(t) {
			sel1.find('option').each(function(){
				if($j(this).is(':selected')) {
					$j(this).attr('selected',false);
					var op = sel2.find('option:first-child');
					sel2.append($j(this));
				}
			});	
		} else {
			sel2.find('option').each(function(){
				if($j(this).is(':selected')) {
					$j(this).attr('selected',false);
					sel1.append($j(this));
				}
			});		
		}
	});
	
	//FORM VALIDATION
	$j("#form1").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			email: {
				required: true,
				email: true,
			},
			location: "required",
			selection: "required"
		},
		messages: {
			firstname: "Please enter your first name",
			lastname: "Please enter your last name",
			email: "Please enter a valid email address",
			location: "Please enter your location"
		}
	});
	
	
	//for checkbox
	$j('input[type=checkbox]').each(function(){
		var t = $j(this);
		t.wrap('<span class="checkbox"></span>');
		t.click(function(){
			if($j(this).is(':checked')) {
				t.attr('checked',true);
				t.parent().addClass('checked');
			} else {
				t.attr('checked',false);
				t.parent().removeClass('checked');
			}
		});
	});	
		
});
