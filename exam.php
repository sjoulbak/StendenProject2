<!doctype HTML>
<html>
<head>

</head>
<body>
    <code>
        <?php
            for($i=6;$i>=0;$i--){
                for($j=6;$j>$i;$j--){
                    echo " 0";
                }
                echo $i != 0 ? " X" : "";

                for($j=0;$j<$i;$j++){
                    echo " 0";
                }
                for($j=1;$j<$i;$j++){
                    echo " 0";
                }
                echo " X";
                for($j=6;$j>$i;$j--){
                    echo " 0";
                }
                echo "<br />";
            }
        ?>
    </code>
</body>
</html>