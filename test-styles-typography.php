<?php
/**
 * Template Name: Test Styles Typography
 */

get_header(); ?>

<h2>Headings</h2>

<h1>Header one</h1>
<h2>Header two</h2>
<h3>Header three</h3>
<h4>Header four</h4>
<h5>Header five</h5>
<h6>Header six</h6>

<h2>Heading Classes (All displayed using a p tag)</h2>

<p class="heading-1">Heading one class</p>
<p class="heading-2">Heading two class</p>
<p class="heading-3">Heading three class</p>
<p class="heading-4">Heading four class</p>
<p class="heading-5">Heading five class</p>
<p class="heading-6">Heading six class</p>

<h2>Paragraph</h2>

<p>This is a normal paragraph.</p>

<p class="no-margin">This is a normal paragraph with no margin bottom.</p>
<p>Next paragrah</p>

<h2>Bold and Italics</h2>

<p><b>B tag</b></p>
<p><strong>Strong tag.</strong></p>
<p><i>Italics tag.</i></p>
<p><em>Emphasis tag.</em></p>
<p class="bold-text">Bold text class.</p>

<h2>Blockquotes</h2>

Single line blockquote:
<blockquote>Stay hungry. Stay foolish.</blockquote>
Multi line blockquote with a cite reference:
<blockquote>People think focus means saying yes to the thing you've got to focus on. But that's not what it means at all. It means saying no to the hundred other good ideas that there are. You have to pick carefully. I'm actually as proud of the things we haven't done as the things I have done. Innovation is saying no to 1,000 things.</blockquote>
<p><cite>Steve Jobs</cite> - Apple Worldwide Developers' Conference, 1997</p>

<h2>Tables</h2>

<table>
<thead>
<tr>
<th>Employee</th>
<th>Salary</th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<th><a href="http://example.org/">John Doe</a></th>
<td>$1</td>
<td>Because that's all Steve Jobs needed for a salary.</td>
</tr>
<tr>
<th><a href="http://example.org/">Jane Doe</a></th>
<td>$100K</td>
<td>For all the blogging she does.</td>
</tr>
<tr>
<th><a href="http://example.org/">Fred Bloggs</a></th>
<td>$100M</td>
<td>Pictures are worth a thousand words, right? So Jane x 1,000.</td>
</tr>
<tr>
<th><a href="http://example.org/">Jane Bloggs</a></th>
<td>$100B</td>
<td>With hair like that?! Enough said...</td>
</tr>
</tbody>
</table>

<h2>Definition Lists</h2>

<dl><dt>Definition List Title</dt><dd>Definition list division.</dd><dt>Startup</dt><dd>A startup company or startup is a company or temporary organization designed to search for a repeatable and scalable business model.</dd><dt>#dowork</dt><dd>Coined by Rob Dyrdek and his personal body guard Christopher "Big Black" Boykins, "Do Work" works as a self motivator, to motivating your friends.</dd><dt>Do It Live</dt><dd>I'll let Bill O'Reilly will <a title="We'll Do It Live" href="https://www.youtube.com/watch?v=O_HyZ5aW76c">explain</a> this one.</dd></dl>

<h2>Unordered Lists (Nested)</h2>

<ul>
	<li>List item one
<ul>
	<li>List item one
<ul>
	<li>List item one</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ul>
</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ul>
</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ul>
<h2>Ordered List (Nested)</h2>
<ol>
	<li>List item one
<ol>
	<li>List item one
<ol>
	<li>List item one</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ol>
</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ol>
</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ol>

<h2>HTML Tags</h2>

These supported tags come from the WordPress.com code <a title="Code" href="http://en.support.wordpress.com/code/">FAQ</a>.

<strong>Address Tag</strong>

<address>1 Infinite Loop
Cupertino, CA 95014
United States</address>

<strong>Anchor Tag (aka. Link)</strong>

<p>This is an example of a <a title="Apple" href="http://apple.com">link</a>.</p>

<strong>Abbreviation Tag</strong>

<p>The abbreviation <abbr title="Seriously">srsly</abbr> stands for "seriously".</p>

<strong>Acronym Tag (<em>deprecated in HTML5</em>)</strong>

<p>The acronym <acronym title="For The Win">ftw</acronym> stands for "for the win".</p>

<strong>Big Tag <strong>(<em>deprecated in HTML5</em>)</strong></strong>

<p>These tests are a <big>big</big> deal, but this tag is no longer supported in HTML5.</p>

<strong>Cite Tag</strong>

<p>"Code is poetry." --<cite>Automattic</cite></p>

<strong>Code Tag</strong>

<p>You will learn later on in these tests that <code>word-wrap: break-word;</code> will be your best friend.</p>

<strong>Definition Tag</strong>

<p>This is a definition <dfn>The Internet</dfn>.</p>

<strong>Delete Tag</strong>

<p>This tag will let you <del>strikeout text</del>, but this tag is no longer supported in HTML5 (use the <code>&lt;strike&gt;</code> instead).</p>

<strong>Insert Tag</strong>

<p>This tag should denote <ins>inserted</ins> text.</p>

<strong>Mark Tag</strong>

<p>This tag should denote <mark>mark</mark> tag.</p>

<strong>Keyboard Tag</strong>

<p>This scarcely known tag emulates <kbd>keyboard text</kbd>, which is usually styled like the <code>&lt;code&gt;</code> tag.</p>

<strong>Preformatted Tag</strong>

<p>This tag styles large blocks of code.</p>

<pre>.post-title {
	margin: 0 0 5px;
	font-weight: bold;
	font-size: 38px;
	line-height: 1.2;
	and here's a line of some really, really, really, really long text, just to see how the PRE tag handles it and to find out how it overflows;
}</pre>

<strong>Quote Tag</strong>

<p><q>Developers, developers, developers...</q> --Steve Ballmer</p>

<strong>Small Tag</strong>

<p>This is some <small>small text</small>.</p>

<strong>Strike Tag <strong>(<em>deprecated in HTML5</em>)</strong></strong>

<p>This tag shows <span style="text-decoration: line-through;">strike-through text</span></p>

<strong>Subscript Tag</strong>

<p>Getting our science styling on with H<sub>2</sub>O, which should push the "2" down.</p>

<strong>Superscript Tag</strong>

<p>Still sticking with science and Isaac Newton's E = MC<sup>2</sup>, which should lift the 2 up.</p>

<strong>Teletype Tag <strong>(<em>deprecated in HTML5</em>)</strong></strong>

<p>This rarely used tag emulates <tt>teletype text</tt>, which is usually styled like the <code>&lt;code&gt;</code> tag.</p>

<strong>Variable Tag</strong>

<p>This allows you to denote <var>variables</var>.</p>

<h2>Horizontal Rule</h2>

<hr />

<hr class="double" />

<h2>Boxes and Warnings</h2>

<p class="box success">This is a boxed success messsage.</p>

<p class="box success-permanent">This is a permanent boxed success messsage.</p>

<p class="success success-plain">This is a plain text success messsage.</p>

<p class="box error">This is a boxed error messsage.</p>

<p class="box error-permanent">This is a permanent boxed error messsage.</p>

<p class="error error-plain">This is a plain text error messsage.</p>

<h2>Horizontal Rule</h2>

<?php get_footer(); ?>