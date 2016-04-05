/**
 * Created by hossam on 04/04/16.
 */
$("#top").remove();
$(function(){
   $(".hotel_submit").on("click",book_hotel);
    function book_hotel(){
        var hotel=$("#hotels").val();
        var from=$(".hotel_from").val();
        var to=$(".hotel_to").val();
        var user_id=$(".user_id").val();
        var members=$(".hotel_members").val();
        $.ajax(
            {
                'url':'/user/bookhotel',
                method:'POST',
                data:{
                    'hotel' : hotel,
                    'from':from,
                    'to':to,
                    'user_id':user_id,
                    'members':members,

                },
                success:alert("Done")
            }
        );


    }

});