$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup", function(){
        /* Get input value on change */
        let inputVal = $(this).val();
        let resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("./include/db/listfood.inc.php", {name: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
});