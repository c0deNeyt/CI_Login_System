    <body>
        <div>
            <a href="/contacts">Go back</a> |
            <a href="#">Edit</a>
        </div>
<?php
        # if the data from data base is != to false
        if($id['details'] != false){
            echo "        <h1>Contact #{$id['details'][0]["Contact_Id"]}</h1>";
            echo "        <p>Name: {$id['details'][0]["Name"]}</p>";
            echo "        <p>Contact Number: {$id['details'][0]["Contact_Number"]}</p>";
        }else
            { echo "<h1>ID not found.</h1>"; }
?>
    </body>
</html>