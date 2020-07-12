$(document).ready(function(){
    $('.list-food input[type="text"]').on("keyup", function(){
        /* Get input value on change */
        let inputVal = $(this).val();
        let result = $(this).siblings(".result");
        
        if(inputVal.length) {
            // get request, name paraméter az input
            $.get("./include/db/listfood.inc.php", {name: inputVal}).done(function(data) {
                result.html(data);
            });
        } else{
            result.empty();
        }
    });
});