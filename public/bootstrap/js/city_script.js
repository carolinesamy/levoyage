/**
 * Created by hossam on 04/04/16.
 */
$("#top").remove();
$(function(){
   $(".hotel_submit").on("click",valid_book_hotel);
    function valid_book_hotel(){
        var hotel=$("#hotels").val();
        var from = $(".hotel_from").val().split("/");
       from = new String (from[2]+"-"+from[0]+"-"+from[1]);
        var to=$(".hotel_to").val().split("/");
        to= new String(to[2]+"-"+ to[0]+"-"+to[1]);
        var user_id=$(".user_id").val();
        var members=$(".hotel_members").val()
        if (members<8&&members!=0&&hotel!="---Select Hotel---"){
            book_hotel(hotel,from,to,user_id,members);
        }else {
            $('#no_rooms').modal();
        }
    }
    function book_hotel(hotel,from,to,user_id,members){
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
                success:sendMail("Test","this is test for ajax")
            }
        );

    }
    function sendMail(subject,message){
        $.ajax(
            {
                'url':'/user/mail',
                method:'POST',
                data:{
                    'subject' : subject,
                    'message':message,
                },
                success:function (){
                    $('#Success_hotel').modal();
                    var from=$(".hotel_from").val("");
                    var to=$(".hotel_to").val("");
                    var members=$(".hotel_members").val("")
                }
            }
        );

    }

});