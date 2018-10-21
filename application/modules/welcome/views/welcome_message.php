<?php 

// $this->load->view("changelog");

?>
/* simple socket operation using html form  */
<p>Current User Details</p>
<?php pf($this->session->userdata); ?>

/* push a notification to another user -- Check list of users in menu system users */

<form id="push">
    <div class="form-group">
        <!-- <label for="message">Message</label> -->
    <div class="row m-3">
        <select name="userslist" id="userslist" class='form-control col-md-2'>
        <?php foreach($users as $u):?>
            <option value="">Select User</option>
            <option value="<?=$u->id?>"><?=$u->first_name?></option>
        <?php endforeach;?>
        </select>
        <input required type="text" placeholder="Hello Alfred, Kujia Lunch Yako (Msg)" id="pushmessage" class="form-control col-md-4 mr-3">
        <button id="pushmessagebtn" class="btn btn-primary col-md-4" >SEND NOTIFICATION</button>
    </div>

    </div>
</form>
<hr>

TODO 
<ol>
    <li>change Alfreds password, login as Alfred to view notification</li>
    <li>Open Alfreds session concurrently / in an alternate window while pushing the notification to view instant result</li>
</ol>





<style>pre { background:#fbe5d3 } input { margin-left:5px; }</style>