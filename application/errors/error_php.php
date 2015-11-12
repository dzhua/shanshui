<?
	if(ENVIRONMENT == 'production') {
		$request_uri = $_SERVER['REQUEST_URI'];
		log_message('error', $request_uri.' '.$heading.' '.$message);
		$path = explode('/', $request_uri);
		if(in_array($path[1], array('admin')))
			Header("Location: /admin/error/500");
		else 
			Header("Location: /error");
		return;
	}
?>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: <?php echo $severity; ?></p>
<p>Message:  <?php echo $message; ?></p>
<p>Filename: <?php echo $filepath; ?></p>
<p>Line Number: <?php echo $line; ?></p>

</div>