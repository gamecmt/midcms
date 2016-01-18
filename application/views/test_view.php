<html>
<head>
    <script type="text/javascript" src="<?php echo base_url();?>assets/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/ueditor/ueditor.all.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/ueditor/themes/default/dialogbase.css"/>
</head>
<body>
<div id="myEditor"></div>
<script type="text/javascript">
    var editor = new baidu.editor.ui.Editor();
    editor.render("myEditor");
</script>
</body>
</html>