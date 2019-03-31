<?php
use core\FH;
?>

<form>
    <div class="form-group">
        <div class="input-group date" id="datepicker" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#datepicker" />
            <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group date" id="timepicker" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" />
            <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
            </div>
        </div>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="dine_in" id="dine_in" value="1">
        <label class="form-check-label" for="dinein">Dine In</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="take_away" id="take_away" value="2">
        <label class="form-check-label" for="take_away">Take Away</label>
    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="">Submit</button>
</form> 