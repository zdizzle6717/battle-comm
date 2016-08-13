// JavaScript Document<script type="text/javascript">
$(document).ready(function() {
    $("#radio_submit").click(function (e) {
        var checked_result_radio = $('input:radio[name=result]:checked').val();
       // var checked_site_radio = $('input:radio[name=user_site]:checked').val();
       
        if(checked_option_radio===undefined) //|| checked_site_radio===undefined)
            {
                alert('Please select both options!');
            }else{
                alert('Your option - "' +checked_result_radio + '"');
				$("#game_result").attr(checked_result_radio);
            }
    });
});

