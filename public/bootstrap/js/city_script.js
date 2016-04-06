/**
 * Created by hossam on 04/04/16.
 */
$("#top").remove();
$(function(){
   $(".hotel_submit").on("click",valid_book_hotel);
    $("#rentCarSubmit").on("click",rent_car_valid);

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
                success:sendMail("Hotel Reservation","you has reserved a room Successfully")
            }
        );

    }

    function rent_car_valid(){
       var pickTime=$("#pickTime").val().replace("T"," ")+":00";
        var leaveTime=$("#leaveTime").val().replace("T"," ")+":00";
        var toLocation=new String($("#toLocation").val());
        var fromLocation=new String($("#fromLocation").val());
            if (fromLocation=="---Select Location---"||toLocation=="---Select Location---"||leaveTime==""||pickTime==""){
                $("#rentCar").modal('toggle');
                $('#no_rooms').modal();
                setTimeout(function(){
                    $('#no_rooms').modal('toggle');
                    $("#rentCar").modal();
                },2000);
                return false;
            }
            else {
                $("#rentCar").modal('toggle');
                $("#Success_hotel").modal();
                rent_car(pickTime,leaveTime,toLocation,fromLocation);
                return false;
            }
    }
    function rent_car(pickTime,leaveTime,toLocation,fromLocation){
        var user_id=$(".user_id").val();
        $.ajax(
            {
                'url':'/user/rentcar',
                method:'POST',
                data:{
                    'from_city' : fromLocation,
                    'to_city':toLocation,
                    'pick_time':pickTime,
                    'leaving_time':leaveTime,
                    'user_id':user_id
                },
                success:sendMail("Car Rent","you has rent a car successfully..")
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