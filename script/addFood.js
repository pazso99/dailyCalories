$(document).ready(function(){
    // food keresés
    $('.add-food input[type="text"]').on("keyup", function(){
        let inputVal = $(this).val();
        let result = $(this).siblings(".result");
        if(inputVal.length){
            $.get("./include/db/dailycalories.inc.php", {food: inputVal}).done(function(data){
                // Display the returned data in browser
                result.html(data);
            });
        } else{
            result.empty();
        }
    });

    // Clicked a specific food -> add to form
    $(document).on("click", ".add-food .result .item", function(){
        $.get("./include/db/dailycalories.inc.php", {addfood: $(this).find(".item-name").text()}).done(function(data){
            // Display the returned data in browser
            $('.form-container').html(data);
        }); 
        $(".result").empty();
        $('.add-food input[type="text"]').val("");
    });
});