<?php
//create a unique id so we cachebust
$id = uniqid(rand(),true);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Media Query Test: Hide an image tag using window.matchMedia</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

	<!-- Basic formatting stuff -->
	<style type="text/css">
	body {
		font: 100%/1.4em Georgia, serif;
	}
	code {white-space:pre;background:#e1e1e1;border:1px solid #ccc;padding:10px;width:100%;display:block;margin-top:5px;}
	h4 {margin-bottom:0;}
	#loaded{
		border: 1px solid #000;
		padding: 20px;
	}
	.load{
		color: green;
	}
	.noload{
		color: red;
	}
	.testLinks{
		font-size: 1.2em;
	}
	.testLinks li{
		margin-bottom: .5em;
	}
	
	</style>
	
	<!-- Test 7 Styles -->
	<style type="text/css">
	
	#test7 { display: none; }
	
	@media all and (min-width: 600px) {
	  /* 
	   * WebKit bug requires that media block referenced by window.matchMedia must be paired with
	   * a MQ in stylesheet that contains at least one CSS rule. 
	   * See http://www.nczonline.net/blog/2012/01/19/css-media-queries-in-javascript-part-2/
	   */
	  body { }
	}
	</style>
	
	<script type="text/javascript">
	var startTime = (new Date().getTime());
	</script>
</head>
<body>
<h1>Media Query Image Download Test</h1>

<p>Lovingly pulled from Cloud Four. <a href="http://www.cloudfour.com/css-media-query-for-mobile-is-fools-gold/">Cloud Four article on media queries</a></p>

<h2 id="t7">Test Seven: Image Tag using window.matchMedia</h2>
<p>
    Simple image tag that will show up when page is greater than 600 pixels wide, but are hidden on smaller screens. This test uses <a href="https://developer.mozilla.org/en/DOM/window.matchMedia">window.matchMedia</a>, a DOM API that exposes media query results to JavaScript.
</p>

<div id="test7">
    <img src="images/test7.png?<?php echo $id; ?>"/>
</div>

<h4>HTML Code</h4>
<code>&#60;div id="test7"&#62;
    &#60;img src="images/test7.png?<?php echo $id; ?>>" /&#62;
&#60;/div&#62;
</code>

<h4>CSS Code</h4>
<code>&#60;style type="text/css"&#62;
@media all and (min-width: 600px) {
  /* 
   * WebKit bug requires that media block referenced by window.matchMedia must be paired with
   * a MQ in stylesheet that contains at least one CSS rule. 
   * See http://www.nczonline.net/blog/2012/01/19/css-media-queries-in-javascript-part-2/
   */
  body { }
}
&#60;/style&#62;
</code>

<h4>JavaScript Code</h4>
<code>&#60;script&#62;
var imageHolder = document.getElementById('test7');

if (window.matchMedia("(min-width: 600px)").matches) {  
  imageHolder.style.display = 'block';
}
&#60;/script&#62;  
</code>

<div id="loaded">
	<h2>Results</h2>
</div>

<?php include('includes/testLinks.inc.php'); ?>

<!-- Test 7 JavaScript -->
<script>
var imageHolder = document.getElementById('test7');

if (window.matchMedia("(min-width: 600px)").matches) {  
  imageHolder.style.display = 'block';
}
</script>

<script type="text/javascript" charset="utf-8">

//use for browserscope
var _bTestResults = {};
//add the widths
_bTestResults['Screen Width'] = screen.width;
_bTestResults['Outer Width'] = window.outerWidth;

window.onload = function() {

	//set the domain prefix so we can just pass image names
	var prefix = 'http://timkadlec.com/mq/';
	
	//set our suffix
    //needed because setting image.src fires request
    //this helps us avoid caching messing with the results
	var suffix = '<?php echo $id; ?>';
	
	//get the div where we'll spit out the results
	var target = document.getElementById('loaded');
	
    //now, create a new image and set it's src
    var image = new Image();
    image.src = 'http://localhost:8888/git/Media-Query-test/images/test7.png?' + suffix;
    
    if (image.complete) {
        target.innerHTML += "<p class='load'>http://timkadlec.com/mq/images/test7.png?" + suffix + " has loaded.</p>";
        //save the result for Browserscope
        _bTestResults['Loaded'] = 1;
        
    } else {
        target.innerHTML += "<p class='noload'>http://timkadlec.com/mq/images/test7.png?" + suffix + " has not loaded.</p>";
        //save the result for Browserscope
        _bTestResults['Loaded'] = 0;
        
    }
		
	// Fetch the Browserscope script that sucks the results from _bTestResults
	(function() {
		var _bTestKey = 'agt1YS1wcm9maWxlcnINCxIEVGVzdBjJ1OINDA';
		var _bScript = document.createElement('script');
		_bScript.src = 'http://www.browserscope.org/user/beacon/' + _bTestKey;
		_bScript.src += '?sandboxid=514f44cc994903e';
		_bScript.setAttribute('async', 'true');
		var scripts = document.getElementsByTagName('script');
		var lastScript = scripts[scripts.length - 1];
		lastScript.parentNode.insertBefore(_bScript, lastScript);
	})();
	
}
</script>
</body>
</html>
