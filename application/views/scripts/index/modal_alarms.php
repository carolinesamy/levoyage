<style>
    .modal-header{
        background-color: #f1c40f;
    }
</style>
<div class="modal fade" id="no_rooms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title glyphicon glyphicon-bell" id="myModalLabel"> Sorry...</h5>
            </div>
            <div class="modal-body">
                Something wrong with your data....!!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Success_hotel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title glyphicon glyphicon-ok-sign" id="myModalLabel"> Done..</h5>
            </div>
            <div class="modal-body">
               Your Request has been sent Successfully....Please check your mail for confirmation..
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rate_city_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title glyphicon glyphicon-ok-sign" id="myModalLabel"> Fead Back</h5>
            </div>
            <div class="modal-body">
                <h2>How do you rate this city?</h2>
                <select  id="rate_menu" class="form-control">
                    <option value="1">Not Bad</option>
                    <option value="2">Good</option>
                    <option value="3">Very Good</option>
                    <option value="4">Amazing</option>
                </select>
                <input type="hidden" value="<?=$this->city->id?>" id="city_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="rate_city_button">Send</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
