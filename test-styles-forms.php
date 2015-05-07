<?php
/**
 * Template Name: Test Styles Forms
 */

get_header(); ?>

<form>

<h2>Checkboxes</h2>

<div class="checkbox-block">
<input type="checkbox" name="vehicle" value="bike" id="bike"><label for="bike">Checkbox 1</label>
</div>
<div class="checkbox-block">
<input type="checkbox" name="vehicle" value="car" id="car"><label for="car">Checkbox 2</label>
</div>

<div class="checkbox-block checkbox-inline">
<input type="checkbox" name="vehicle2" value="bike2" id="bike2"><label for="bike2">Checkbox 1</label>
<input type="checkbox" name="vehicle2" value="car2" id="car2"><label for="car2">Checkbox 2</label>
</div>

<h2>Password</h2>

<label for="psw">Password:</label>
<input type="password" name="psw" id="psw">

<h2>Radio</h2>

<div class="checkbox-block">
<input type="radio" name="sex" value="male" id="male" checked><label for="male">Radio 1</label>
</div>
<div class="checkbox-block">
<input type="radio" name="sex" value="female" id="female" ><label for="female">Radio 2</label>
</div>

<div class="checkbox-block checkbox-inline">
<input type="radio" name="sex2" value="male2" id="male2" checked><label for="male2">Radio 1</label>
<input type="radio" name="sex2" value="female2" id="female2"><label for="female2">Radio 2</label>
</div>

<h2>Select</h2>

<label for="cars">Select</label>
<select name="cars" id="cars">
<option value="volvo">Volvo</option>
<option value="saab">Saab</option>
<option value="fiat">Fiat</option>
<option value="audi">Audi</option>
</select>

<select name="cars2" multiple>
<option value="volvo">Volvo</option>
<option value="saab">Saab</option>
<option value="fiat">Fiat</option>
<option value="audi">Audi</option>
</select>

<h2>Text</h2>

<label for="firstname">Text:</label>
<input type="text" name="firstname" id="firstname" placeholder="Placeholder">

<h2>Textarea</h2>

<label for="message">Textarea:</label>
<textarea name="message" id="message" rows="10" cols="30">
The cat was playing in the garden.
</textarea>

<h2>Fieldset and Legend</h2>

<fieldset>
<legend>I AM LEGEND</legend>
<label for="legtext">Test Form on Legend:</label>
<input type="text" name="legtext" id="legtext" placeholder="Placeholder">
</fieldset>

<h2>HTML 5</h2>

<h2>Color</h2>

<label for="favcolor">Color:</label>
<input type="color" name="favcolor" id="favcolor">

<h2>Date</h2>

<label for="bday">Date:</label>
<input type="date" name="bday" id="bday">

<h2>Date Time</h2>

<label for="bdaytime">Date Time:</label>
<input type="datetime" name="bdaytime" id="bdaytime">

<h2>Date Time Local</h2>

<label for="bdaytime">Date Time Local:</label>
<input type="datetime-local" name="bdaytime" id="bdaytime">

<h2>Email</h2>

<label for="email">Email:</label>
<input type="email" name="email" id="email">

<h2>Month</h2>

<label for="bdaymonth">Month:</label>
<input type="month" name="bdaymonth" id="bdaymonth">

<h2>Quantity</h2>

<label for="quantity">Quantity:</label>
<input type="number" name="quantity" id="quantity">

<h2>Search</h2>
			
<input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:">
<input type="submit" class="search-submit" value="Search">

<h2>Tel</h2>

<label for="usrtel">Tel:</label>
<input type="tel" name="usrtel" id="usrtel">

<h2>Time</h2>

<label for="usr_time">Time:</label>
<input type="time" name="usr_time" id="usr_time">

<h2>URL</h2>

<label for="homepage">URL:</label>
<input type="url" name="homepage" id="homepage">

<h2>Week</h2>

<label for="week_year">Week:</label>
<input type="week" name="week_year" id="week_year">

<h2>Buttons</h2>

<h2>Input Button</h2>

<input type="button" onclick="alert('Hello World!')" value="Clicky">

<h2>Input Reset</h2>

<input type="reset" value="Reset">

<h2>Input Submit</h2>

<input type="submit" value="Clicky">

<h2>Button</h2>

<button>Clicky</button>

<h2>Button Full Width</h2>

<button class="full-width">Clicky</button>

<h2>a Class Button</h2>

<a href="#" class="button">Clicky</a>

<h2>a Class Button Full Width</h2>

<a href="#" class="button full-width">Clicky</a>

<h2>Input Button (Round)</h2>

<input type="button" onclick="alert('Hello World!')" value="Clicky" class="round-button">

<h2>Input Reset (Round)</h2>

<input type="reset" value="Reset" class="round-button">

<h2>Input Submit (Round)</h2>

<input type="submit" value="Clicky" class="round-button">

<h2>Button (Round)</h2>

<button class="round-button">Clicky</button>

<h2>Button Full Width (Round)</h2>

<button class="full-width round-button">Clicky</button>

<h2>a Class Button (Round)</h2>

<a href="#" class="button round-button">Clicky</a>

<h2>a Class Button Full Width (Round)</h2>

<a href="#" class="button full-width round-button">Clicky</a>

<h2>Input Button (Bevelled)</h2>

<input type="button" onclick="alert('Hello World!')" value="Clicky" class="bevelled-button">

<h2>Input Reset (Bevelled)</h2>

<input type="reset" value="Reset" class="bevelled-button">

<h2>Input Submit (Bevelled)</h2>

<input type="submit" value="Clicky" class="bevelled-button">

<h2>Button (Bevelled)</h2>

<button class="bevelled-button">Clicky</button>

<h2>Button Full Width (Bevelled)</h2>

<button class="full-width bevelled-button">Clicky</button>

<h2>a Class Button (Bevelled)</h2>

<a href="#" class="button bevelled-button">Clicky</a>

<h2>a Class Button Full Width (Bevelled)</h2>

<a href="#" class="button full-width bevelled-button">Clicky</a>

</form>

<?php get_footer(); ?>