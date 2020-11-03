"use strict";
$(window).on('load', function () {
var options4 = {

  url: function(phrase) {
	  if (phrase !== "") {
            return "pgsl/atu_autocomplete.php?nome="+ phrase +"";
        } else {
            //duckduckgo doesn't support empty strings
            return "pgsl/atu_autocomplete.php";
        }
  },

  getValue: function(element) {
    return element.nome;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  preparePostData: function(data) {
    data.phrase = $("#example-ajax-post").val();
	
    return data;
  },
  
  list: {
        onSelectItemEvent: function() {
            var selectedItemValue = $("#example-ajax-post").getSelectedItemData().codigo;
            $("#codigo").val(selectedItemValue).trigger("change");
        },
    },

  requestDelay: 400
};
$("#example-ajax-post").easyAutocomplete(options4);
});

$(window).on("resize", function () {
$("#example-ajax-post").easyAutocomplete(options4);
});
