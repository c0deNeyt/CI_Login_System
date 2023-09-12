    <body>
<?php
    if (isset($status) && !empty($status)){
        echo "test";
    }
?>            
        <a href="/">Go back</a>
        <h1>Add New Contact</h1>
<?php
    //if(isset($postData)){
        //var_dump($postData);
    //}
?>
        <form action="/contacts/create" method="post">
            <input type="hidden" name="action" value="post"/>
            <label>First Name:
                <input type="text" name="fname"/>
            </label>
            <label>Last Name:
                <input type="text" name="lname"/>
            </label>
            <label> Contact Number:
                <input type="number" name="number"/>
            </label>
            <input type="submit" value="Create"/>
        </form>
    </body>
</html>
