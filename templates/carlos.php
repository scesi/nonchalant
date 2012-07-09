<?php echo $this->doctype('HTML5') ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>/bin/nch</title>
        <meta http-equiv="Content-Type"
              content="text/html; charset=utf-8" />
        <link href="docs/scesi/nonchalant.png" rel="icon" />
        <link href="css/carlos/style.css" media="screen"
              rel="stylesheet" type="text/css" />
    </head>
    <body class="c4">
        <div id="header"></div>
        <div id="wrapper">
            <div id="main">
                <pre><?php echo $this->output ?></pre>
                <form action="" method="post">
                    <?php echo $this->escape($this->hostname) ?>!<?php echo $this->escape($this->user) ?>
                    <?php echo $this->escape($this->prompt) ?>
                    <input id="command" name="comando" type="text" autocomplete="off" />
                </form>
            </div>
            <div id="footer">
                <a href="http://scesi.fcyt.umss.edu.bo/"
                   target="_BLANK">SCESI</a>
                <a href="http://www.memi.umss.edu.bo/"
                   target="_BLANK">MEMI</a>
                <a href="https://github.com/ccaballero/nonchalant">Código fuente</a></div>
        </div>
        <script type="text/javascript">window.onload=function(){document.getElementById("command").focus();}</script>
    </body>
</html>
