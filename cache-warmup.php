<?php
    $id = $_GET['id'];
	$linex = $_GET['line'];
	if (!isset($linex)) { $linex = 0;};

	
?>
<html>
<head>
<!-- Created by Liquid-i -->
</head>
<body>

<form name="input" action="cache-warmup.php" method="get">
<h3>Magento Cache Warm Up</h3>
<p>Please enter your Magento Sitemap, the line to start at and click on submit.</br>The script will walk through your sitemap urls and load the pages in the iframe.</p>
<span style="width:150px;float:left;">Magento Sitemap:</span> <input size="100" type="text" name="id" value="<?php echo $id;?>" ><br>
<span style="width:150px;float:left;">Start by line:</span><input size="6" type="text" name="line" value="<?php echo $linex;?>"><br>
<input type="submit" value="Submit">
</form

<?php
      echo $id . "<br>";
	  if (fopen($id,"r")) {
         $xml = simplexml_load_file($id);
		echo "File exist <br>";  
?>

	<script type="text/javascript">
		var urls=new Array();
<?php
		for($i=0,$size=count($xml);$i<$size;$i++)
			{
				echo "urls[".$i."] = '". $xml->url[$i]->loc ."';\n";
			}
?>
	</script>
		
	<p id="meinAbsatz">Text</p>
	<iframe width="800px" height="700px" src="" id="framy"></iframe>
		
	<script type="text/javascript">
		var urlaktuell = <?php echo $linex ; ?>;
		setTimeout("url()", 3000);

		function url()
			{
				document.getElementById('framy').src = (urls[urlaktuell]);
				urlaktuell++;
				document.all.meinAbsatz.innerHTML = (urls[urlaktuell] + ' : ' + urlaktuell);
				if(urlaktuell == urls.length)
					{
						urlaktuell = 0;
					}
				setTimeout("url()", 6000);
			}
	</script>
<?php    

        
}
 else {
   exit("Could not load the file");
}
?>


</body></html>