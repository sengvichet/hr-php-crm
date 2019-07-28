<div class="eventsPageSubtitle">Harassment Prevention Training</div>
<p><strong>Who should attend this meeting?</strong></p>
<ul>
  <li>Business Owners</li>
  <li>Supervisors</li>
  <li>HR Professionals</li>
</ul>
<p><strong>Did You Know?</strong></p>
<p>Some California employers are required to complete mandatory training under California AB1825. This training is facilitated by a qualified trainer, and meets AB1825 compliance requirements.</p>
<p><em>Space is limited. Register today!</em></p>
<hr>
<?php
	if(!isset($_POST['contactformsubmit']))
	{
?>
<div class="col-md-6">
  <div class="formContain eventsFormContain">
    <form action="events.php" method="post" name="contactform">
      <div class="formSection" style="padding-top:0px;">
        <label for="first_name">First Name (required)</label>
        <input maxlength="50" name="first_name" size="30" type="text" required>
      </div>
      <div class="formSection">
        <label for="last_name">Last Name (required)</label>
        <input maxlength="50" name="last_name" size="30" type="text" required>
      </div>
      <div class="formSection">
        <label for="position">Position</label>
        <input maxlength="50" name="position" size="30" type="text">
      </div>
      <div class="formSection">
        <label for="organization">Organization</label>
        <input maxlength="50" name="organization" size="30" type="text">
      </div>
      <div class="formSection">
        <label for="email">Email (required)</label>
        <input maxlength="80" name="email" size="30" type="email" required>
      </div>
      <div class="formSection">
        <label for="telephone">Phone Number (with area code)</label>
        <input maxlength="30" name="telephone" size="30" type="tel">
      </div>
      <div class="formSection">
        <label for="offercode">Offer Code? Enter here</label>
        <input maxlength="50" name="offercode" size="30" type="text">
      </div>
      <div class="formSection">
        <label for="numOfGuests">How many guests would you like to register?</label>
        <select name="numOfGuests" required>
          <option value="">Please Select</option>
          <option value="1" selected="selected">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>      
      <div class="formSection">
        <label for="paymentSelect">How would you like to pay for this event?</label>
        <select id="paymentSelect" name="paymentSelect" required>
          <option value="">Please Select</option>
          <option value="payNow">Pay Now via PayPal</option>
          <option value="payLater">Pay Later</option>
        </select>
      </div>
      <div class="formSection" style="text-align:center">
        <input type="hidden" name="event_selected" value="" id="eventSelected">
        <input type="hidden" name="event_emailContent" value="1">
        <input type="submit" value="Submit" name="contactformsubmit" style="width: 36%; height: 2.2em;">
      </div>
    </form>
  </div>
</div>
<div class="col-md-6 eventInformation">
  <p><strong class="subhead">Program Details</strong><br>
    Thursday September 15, 2016<br>
    8:00AM Registration<br>
    8:30 - 10:30AM Training</p>
  <p><strong class="subhead">Location</strong><br>
    601 University Ave, Suite 250<br>
    Sacramento, CA 95825</p>
  <p><strong class="subhead">Cost</strong><br>
    $69 per person</p>
  <p><strong class="subhead">Questions?</strong><br>
    Call us at <a href="tel:8888055421">888-805-5421</a><br>
    or email <a href="mailto:info@hrdoneright.com">info@hrdoneright.com</a></p>
</div>
<?php
	}
?>
