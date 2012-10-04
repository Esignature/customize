(function(){
	var exampleDialog = function(editor){
		return {
			title: "Params",
			resizable: 'none', //CKEDITOR.DIALOG_RESIZE_NONE,
			width: 80,
			height: 40,
			contents: [{
				id: "params",
				label: "Params",
				title: "Params",
				expand: true,
				padding: 0,
				elements: [{
					label: "Param",
					type: "select",
					id: "param",
					items: [
						["Current year, month, day", "{vt::date}"],
						["Current year, numeric month, day", "{vt::date_short}"],
						["Current hours, minutes, seconds", "{vt::time}"],
						["Current hours, minutes", "{vt::time_short}"],
						["Current date and time", "{vt::datetime}"],
						["Current date and time (short)", "{vt::datetime_short}"],
						["Current date and time (custom format)", "{vt::strftime(%d.%m.%Y %H:%M)}"],
						["Visit ID", "{vt::vid}"],
						["Search word", "{vt::srch_word:default()}"],
						["Referrer type", "{vt::ref_type:default()}"],
						["First visit ID", "{vt::1_vid}"],
						["First search word", "{vt::1_srch_word:default()}"],
						["First referrer type", "{vt::1_ref_type:default()}"],
						["Current URL", "{vt::url}"],
						["Current referrer", "{vt::ref:default()}"],
						["User ID", "{vt::uid}"],
						["A segment of User ID", "{vt::uid_short}"],
						["Session start time", "{vt::ss_datetime}"],
						["Number of past visits", "{vt::pv}"],
						["Last past visit time", "{vt::ls_datetime}"],
						["Country", "{vt::country:default()}"],
						["Region", "{vt::region:default()}"],
						["City", "{vt::city:default()}"],
						["IP address", "{vt::ip}"],
						["custom i_1", "{vt::custom_i_1:default()}"],
						["custom_i_2", "{vt::custom_i_2:default()}"],
						["custom_i_3", "{vt::custom_i_3:default()}"],
						["custom_i_4", "{vt::custom_i_4:default()}"],
						["custom_f_1", "{vt::custom_f_1:default()}"],
						["custom_f_2", "{vt::custom_f_2:default()}"],
						["custom_t_1", "{vt::custom_t_1:default()}"],
						["custom_t_2", "{vt::custom_t_2:default()}"],
						["custom_t_3", "{vt::custom_t_3:default()}"],
						["custom_t_4", "{vt::custom_t_4:default()}"],
						["custom_t_5", "{vt::custom_t_5:default()}"],
						["custom_t_6", "{vt::custom_t_6:default()}"],
						["first_name", "{vt::first_name:default()}"],
						["middle_name", "{vt::middle_name:default()}"],
						["last_name", "{vt::last_name:default()}"],
						["email", "{vt::email:default()}"],
						["sex", "{vt::sex:default()}"],
						["meeting_sex", "{vt::meeting_sex:default()}"],
						["birthday", "{vt::birthday:default()}"],
						["timezone", "{vt::timezone:default()}"],
						["fb_friends_count", "{vt::fb_friends_count:default()}"],
						["religion", "{vt::religion:default()}"],
						["current_city", "{vt::current_city:default()}"],
						["current_state", "{vt::current_state:default()}"],
						["current_country", "{vt::current_country:default()}"],
						["hometown_city", "{vt::hometown_city:default()}"],
						["hometown_state", "{vt::hometown_state:default()}"],
						["hometown_country", "{vt::hometown_country:default()}"],
						["relationship_status", "{vt::relationship_status:default()}"],
						["political", "{vt::political:default()}"],
						["allowed_restrictions", "{vt::allowed_restrictions:default()}"],
						["website", "{vt::website:default()}"],
						["interests", "{vt::interests:default()}"],
						["education_year", "{vt::education_year:default()}"],
						["education_name", "{vt::education_name:default()}"],
						["education_degree", "{vt::education_degree:default()}"],
						["birth_year_from", "{vt::birth_year_from:default()}"],
						["birth_year_to", "{vt::birth_year_to:default()}"],
						["n_children_from", "{vt::n_children_from:default()}"],
						["n_children_to", "{vt::n_children_to:default()}"],
						["phone", "{vt::phone:default()}"],
						["phone_mobile", "{vt::phone_mobile:default()}"],
						["opted_in", "{vt::opted_in:default()}"],
						["conversion_last", "{vt::conversion_last:default()}"],
						["conversion_history", "{vt::conversion_history:default()}"],
						["last_interest", "{vt::last_interest:default()}"],
						["total_goal_value", "{vt::total_goal_value:default()}"],
						["total_buy_value", "{vt::total_buy_value:default()}"],
						["n_buys", "{vt::n_buys:default()}"]
					]
				}]
			}],
			onOk: function() {
				editor.insertText(this.getContentElement("params", "param").getValue());
			}
		}
	}
	
	CKEDITOR.dialog.add("vt_insertparams", function(editor) {
    	return exampleDialog(editor)
    });
	
})()


			