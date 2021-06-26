<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="playground.js"
            data-selector=".language-kotlin"></script>
    <script type="text/javascript">

        function logExtern(task, code, errorsAndWarnings, output) {
            console.log("logExtern");
            // do nothing
        }
    </script>
    <link rel="stylesheet" href="style.css">
    <link rel="Shortcut Icon" href="https://kotlinlang.org/assets/images/favicon.ico" type="image/x-icon"/>
</head>
<body>
<?php
include_once("mappings.php");

foreach ($mappings as $mapping) {
?>
<h3><?php echo $mapping["Name"]; ?></h3>
<div style="display: grid; grid-template-columns: 120px 1fr;">
    <div><b>Regex: </b></div><div><?php echo $mapping["Regex"]; ?></div>
    <div><b>Problem: </b></div><div><?php echo $mapping["Problem"]; ?></div>
    <div><b>Solution hint: </b></div><div><?php echo $mapping["Hint"]; ?></div>
    <div><b>Example: </b></div><div><?php echo $mapping["Example"]; ?></div>
    <div><b>Link: </b></div><div><?php echo $mapping["Link"]; ?></div>
</div>

<code class="language-kotlin" task="<?php echo preg_replace("/[^A-Za-z]/", '', $mapping["Name"]); ?>" data-target-platform="js" folded-button="true" auto-indent="true" indent="4"
  lines="true" data-autocomplete="true">
<?php echo $mapping["Test"]; ?>
</code>
<?php
}
?>

<script>
    setTimeout(function () {
        //$(".run-button").click();
    }, 1000);
</script>

</body>
