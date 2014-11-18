<?php
/**
 * Template Name: Test Styles Form Fields
 */

get_header(); ?>

<form>

<label for="firstname">Text:</label>
<input type="text" name="firstname" id="firstname" placeholder="Placeholder">

<label for="psw">Password:</label>
<input type="password" name="psw" id="psw">

<div class="checkbox_block">
<input type="radio" name="sex" value="male" id="male" checked><label for="male">Radio 1</label>
</div>
<div class="checkbox_block">
<input type="radio" name="sex" value="female" id="female" ><label for="female">Radio 2</label>
</div>

<div class="checkbox_block">
<input type="radio" name="sex2" value="male2" id="male2" checked><label for="male2">Radio 1</label>
<input type="radio" name="sex2" value="female2" id="female2" class="checkbox_inline"><label for="female2">Radio 2</label>
</div>

<div class="checkbox_block">
<input type="checkbox" name="vehicle" value="bike" id="bike"><label for="bike">Checkbox 1</label>
</div>
<div class="checkbox_block">
<input type="checkbox" name="vehicle" value="car" id="car"><label for="car">Checkbox 2</label>
</div>

<div class="checkbox_block">
<input type="checkbox" name="vehicle2" value="bike2" id="bike2"><label for="bike2">Checkbox 1</label>
<input type="checkbox" name="vehicle2" value="car2" id="car2" class="checkbox_inline"><label for="car2">Checkbox 2</label>
</div>

<label for="cars">Cars</label>
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

<label for="message">Message</label>
<textarea name="message" id="message" rows="10" cols="30">
The cat was playing in the garden.
</textarea>

<h1>HTML 5</h1>

<label for="quantity">Quantity:</label>
<input type="number" name="quantity" id="quantity">

<label for="usrtel">Tel:</label>
<input type="tel" name="usrtel" id="usrtel">

<label for="homepage">URL:</label>
<input type="url" name="homepage" id="homepage">

<label for="bday">Date:</label>
<input type="date" name="bday" id="bday">

<label for="bdaytime">Date Time:</label>
<input type="datetime" name="bdaytime" id="bdaytime">

<label for="bdaytime">Date Time Local:</label>
<input type="datetime-local" name="bdaytime" id="bdaytime">

<label for="week_year">Week:</label>
<input type="week" name="week_year" id="week_year">

<label for="bdaymonth">Month:</label>
<input type="month" name="bdaymonth" id="bdaymonth">

<label for="usr_time">Time:</label>
<input type="time" name="usr_time" id="usr_time">

<label for="favcolor">Color:</label>
<input type="color" name="favcolor" id="favcolor">

<label for="email">Email:</label>
<input type="email" name="email" id="email">

<label for="googlesearch">Search:</label>
<input type="search" name="googlesearch" id="googlesearch">

<input type="button" onclick="alert('Hello World!')" value="Clicky">

<input type="submit" value="Clicky">

<input type="reset" value="Reset">

<button>Clicky</button>

<a href="#" class="button">Clicky</a>

<button class="full_width">Clicky</button>

<a href="#" class="button full_width">Clicky</a>

<input type="button" onclick="alert('Hello World!')" value="Clicky" class="round_button">

<input type="submit" value="Clicky" class="round_button">

<input type="reset" value="Reset" class="round_button">

<button class="round_button">Clicky</button>

<a href="#" class="button round_button">Clicky</a>

<button class="full_width round_button">Clicky</button>

<a href="#" class="button full_width round_button">Clicky</a>

</form>

<?php get_footer(); ?>