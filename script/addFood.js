$(document).ready(function(){
    $('.add-food input[type="text"]').on("keyup", function(){
        /* Get input value on change */
        let inputVal = $(this).val();
        let resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("./include/db/dailycalories.inc.php", {food: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".add-food .result .item", function(){
        $.get("./include/db/dailycalories.inc.php", {addfood: $(this).find(".item-name").text()}).done(function(data){
            // Display the returned data in browser
            $('.form-container').html(data);
        }); 
        $(".result").empty();
        $('.add-food input[type="text"]').val("");
    });
});