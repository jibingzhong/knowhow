<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf8">
<title>Insert title here</title>
<script type="text/javascript" src="/knowhow/Public/js/jquery.min.js"></script>
</head>
<body>
		<input type='button' value="log"/>

	<script type="text/javascript">
		$(':button').click(function(){
			$.ajax({
				type:'post',
				url:"<?php echo U('Test/Down');?>",
				success:function(data){
					$('div').fadeIn('').fadeOut('')
				}
			})
		})
	</script>
</body>
</html>