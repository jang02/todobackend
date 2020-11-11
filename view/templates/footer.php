<?php

if (isset($_SESSION["olddata"])){
    unset($_SESSION["olddata"]);
}

?>

</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">


    $(document).ready( function(){
        var hide_delay = 0;  // starting timeout before first message is hidden
        var hide_next = 500;   // time in mS to wait before hiding next message
        $(".alert").hide().each( function(index,el) {
            window.setTimeout( function(){
                $(el).slideDown();  // hide the message
            }, hide_delay + hide_next*index);
        });
    });

    $(document).ready( function(){
        var hide_delay = 2500;  // starting timeout before first message is hidden
        var hide_next = 500;   // time in mS to wait before hiding next message
        $(".alert").slideDown().each( function(index,el) {
            window.setTimeout( function(){
                $(el).slideUp();  // hide the message
            }, hide_delay + hide_next*index);
        });
    });




</script>

</html>